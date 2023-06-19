<?php

namespace App\Services;

use Log;
use Exception;
use Aws\S3\S3Client;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class UploadService
{
    /**
     * @var boolean
     */
    protected $isLocal;

    /**
     * @var string
     */
    protected $rootLocalUpload = 'app/public';

    /**
     * UploadService constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->isLocal = (config('app.env') === 'local');

        if ($this->isLocal) {
            $this->initLocal();
        }
    }

    /**
     * Init local.
     *
     * @return void
     */
    public function initLocal()
    {
        $adapter = new Local(storage_path($this->rootLocalUpload));
        new Filesystem($adapter);
    }

    public function deleteImage(string $path)
    {
        try {
            if ($this->isLocal) {
                return Storage::disk('local')->delete($path);
            }
        } catch (Exception $e) {
            FacadesLog::error('[DELETE_IMAGE] =>' . $e->getMessage());

            return false;
        }
    }

    public function upload(object $file, string $path, bool $private = false, bool $isRename = true)
    {
        $fileName = $this->getFileName($file, $isRename);
        $path = $this->getUploadKey($path, $fileName);
        if ($this->isLocal) {
            Storage::disk('public')->put($path, file_get_contents($file));
        }

        if (!$fileName) {
            throw new \Exception('Upload false');
        }

        return [
          'name' => $file->getClientOriginalName(),
          'path' => $path,
          'type' => $file->getClientOriginalExtension(),
          'size' => $file->getSize(),
          'storage_path' => $this->getShortPublicUrl($path)
        ];
    }

    public function getFileName(object $file, bool $isRename = true): string
    {
        $fileName = $file->getClientOriginalName();
        if ($isRename) {
            $fileName = $this->encryptFileName(
                $this->randomString(),
                $file->getClientOriginalExtension()
            );
        }

        return $fileName;
    }

    public function getUploadKey(string $path, string $name): string
    {
        return sprintf('%s/%s', $path, $name);
    }

    public function encryptFileName(string $id, string $ext)
    {
        return sprintf("%s.%s", md5($id), $ext);
    }

    public function randomString()
    {
        return md5(uniqid((string) rand(), true));
    }

    public function getShortPublicUrl(string $path)
    {
        try {
            if ($this->isLocal) {
                return Storage::disk('local')->url($path);
            }
        } catch (Exception $e) {
            FacadesLog::error('GET_PUBLIC_URL:' . $e->getMessage());

            return null;
        }//end try
    }
}

<?php

namespace App\Services\Candidate;

use App\Services\UploadService;
use Illuminate\Http\Request;
use App\Repositories\Candidate\AttachmentRepository;
use App\Repositories\Candidate\ResumeRepository;

class AttachmentService
{
    /**
     * @var ResumeRepository
     */
    protected $resumeRepository;

    /**
     * @var AttachmentRepository
     */
    protected $attachmentRepository;

    /**
     * @var UploadService
     */
    protected $uploadService;

    /**
     * AttachmentService constructor.
     *
     * @param AttachmentRepository $attachmentRepository
     * @param ResumeRepository $resumeRepository
     * @param UploadService $uploadService
     */
    public function __construct(
        AttachmentRepository $attachmentRepository,
        ResumeRepository $resumeRepository,
        UploadService $uploadService
    ) {
        $this->attachmentRepository = $attachmentRepository;
        $this->resumeRepository = $resumeRepository;
        $this->uploadService = $uploadService;
    }

    /**
     * Store resume or attachment.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function store(Request $request)
    {
        $candidateId = auth('web')->user()->id;
        // Create candidate attachment
        if (!empty($request->file('attachment'))) {
            return $this->updateOrCreateByType(
                $candidateId,
                $request->file('attachment')
            );
        }

        return true;
    }

    /**
     * Handle upload file attachment
     *
     * @param int    $candidateId
     * @param object $file
     *
     * @return bool
     */
    public function updateOrCreateByType(int $candidateId, object $file)
    {
        // Check delete old file
        $attachment = $this->attachmentRepository->getByCandidateId($candidateId);
        if ($attachment && $attachment->upload_file_path) {
            $this->uploadService->deleteImage($attachment->upload_file_path);
        }

        // Upload file
        $fileData = $this->uploadService->upload(
            $file,
            sprintf('candidates/%d/attachments', $candidateId)
        );

        // Create or update data
        return $this->attachmentRepository->updateOrCreate($candidateId, [
            'upload_file_name' => $fileData['name'],
            'upload_file_path' => $fileData['path'],
        ]);
    }
}

<?php

namespace App\Models;

use App\Models\Relationships\CompanyRelationship;
use App\Notifications\Company\MailRegister;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Company extends Authenticatable implements MustVerifyEmail
{
    use MustVerifyEmailTrait,
        HasFactory,
        SoftDeletes,
        CompanyRelationship,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_no',
        'name',
        'address',
        'status',
        'phone_company',
        'email_company',
        'fax_company',
        'name_person',
        'phone',
        'email',
        'password',
        'email_verified_at',
        'password_changed_at',
        'verify_code',
        'upload_file_name',
        'upload_file_path',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'verified_at',
        'password_changed_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            // Set up variables for the directory and file paths
            $directory = 'company';
            $originalPath = 'images/company/avatar5.jpg';
            $fileName = FileFacade::basename($originalPath);
            $fileExtension = FileFacade::extension($originalPath);
            $destinationPath = $directory . '/' . $model->id . '/' . Str::random(10) . '.' . $fileExtension;

            // Ensure the original file exists
            if (FileFacade::exists(public_path($originalPath))) {
                // Create a File instance and upload it using Storage
                $file = new File(public_path($originalPath));
                Storage::disk('public')->putFileAs('', $file, $destinationPath);

                // Set model attributes
                $model->upload_file_name = $fileName;
                $model->upload_file_path = $destinationPath;
            } else {
                // Handle case where file does not exist
                Log::error("File not found at path: " . public_path($originalPath));
            }
        });
    }

    public static $status = [
        'active' => 1,
        'blacklist' => 0
    ];

    public function sendMailRegister(): void
    {
        $this->notify(new MailRegister());
    }
}

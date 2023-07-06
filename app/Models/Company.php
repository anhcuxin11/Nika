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

    public static $status = [
        'active' => 1,
        'blacklist' => 0
    ];

    public function sendMailRegister(): void
    {
        $this->notify(new MailRegister());
    }
}

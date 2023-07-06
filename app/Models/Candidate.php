<?php

namespace App\Models;

use App\Models\Attributes\CandidateAttribute;
use App\Models\Relationships\CandidateRelationship;
use App\Notifications\Candidate\MailRegister;
use App\Notifications\Company\MailApply;
use App\Notifications\Company\MailResufe;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Candidate extends Authenticatable implements MustVerifyEmail
{
    use MustVerifyEmailTrait,
        HasFactory,
        CandidateAttribute,
        CandidateRelationship,
        SoftDeletes,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'password',
        'status',
        'email_verified_at',
        'password_changed_at',
        'verify_code',
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
        'unactive' => 0
    ];

    public function sendReplyApplicationNotification(Company $company, Job $job): void
    {
        $this->notify(new MailApply($company, $job));
    }

    public function sendRefuseApplicationNotification(Company $company, Job $job): void
    {
        $this->notify(new MailResufe($company, $job));
    }

    public function sendMailRegister(): void
    {
        $this->notify(new MailRegister());
    }
}

<?php

namespace App\Models;

use App\Models\Relationships\MessageRelationship;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use MessageRelationship;

    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidate_id',
        'company_id',
        'job_id',
        'type',
        'text',
    ];

    public static $type = [
        'candidate' => 1,
        'company' => 2
    ];
}

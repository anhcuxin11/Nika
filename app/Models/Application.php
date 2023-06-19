<?php

namespace App\Models;

use App\Models\Relationships\ApplicationRelationship;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use ApplicationRelationship;

    protected $table = 'applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidate_id',
        'job_id',
        'status'
    ];

    public static $status = [
        0 => 'Unconfimred',
        1 => 'Compatible',
        2 => 'Incompatible',
    ];

    const MESSAGECOMPATILE = 'Thank you for your trust, can you spare some time regarding this work.';
    const MESSAGEINCOMPATILE = 'Your current job is not suitable for you, good luck with other jobs.';
}

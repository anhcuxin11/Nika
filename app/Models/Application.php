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
    ];
}

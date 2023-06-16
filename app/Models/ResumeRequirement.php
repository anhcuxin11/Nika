<?php

namespace App\Models;

use App\Models\Relationships\ResumeRequirementRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResumeRequirement extends Model
{
    use SoftDeletes,
        ResumeRequirementRelationship;

    protected $table = 'resume_requirements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resume_id',
        'requirement_salary',
    ];
}

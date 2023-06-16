<?php

namespace App\Models;

use App\Models\Relationships\ResumeRequirementOccupationRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResumeRequirementOccupation extends Model
{
    use SoftDeletes,
        ResumeRequirementOccupationRelationship;

    protected $table = 'resume_requirement_occupations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resume_id',
        'occupation_id',
    ];
}

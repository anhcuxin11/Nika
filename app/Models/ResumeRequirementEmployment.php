<?php

namespace App\Models;

use App\Models\Attributes\ResumeRequirementEmploymentAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResumeRequirementEmployment extends Model
{
    use ResumeRequirementEmploymentAttribute,
        SoftDeletes;

    protected $table = 'resume_requirement_employments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resume_id',
        'requirement_employment',
    ];

    public static $requirementEmployment = [
        'permanent' => 0,
        'contractor' => 1,
        'outsourcing'  => 2,
        'contingent_worker'  => 3,
        'part_time' => 4,
    ];
}

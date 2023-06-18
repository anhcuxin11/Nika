<?php
namespace App\Models;

use App\Models\Relationships\ResumeRequirementIndustryRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResumeRequirementIndustry extends Model
{
    use SoftDeletes,
        ResumeRequirementIndustryRelationship;

    protected $table = 'resume_requirement_industries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resume_id',
        'industry_id',
    ];
}

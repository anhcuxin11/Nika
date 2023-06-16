<?php

namespace App\Models\Relationships;

use App\Models\Candidate;
use App\Models\Industry;
use App\Models\Location;
use App\Models\Occupation;
use App\Models\ResumeIndustry;
use App\Models\ResumeOccupation;
use App\Models\ResumeRequirement;
use App\Models\ResumeRequirementEmployment;
use App\Models\ResumeRequirementIndustry;
use App\Models\ResumeRequirementLocation;
use App\Models\ResumeRequirementOccupation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait ResumeRelationship
{
    public function industries(): BelongsToMany
    {
        return $this->belongsToMany(Industry::class, 'resume_industries')
                    ->withTimestamps();
    }

    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(Occupation::class, 'resume_occupations')
                    ->withTimestamps()->withPivot('year');
    }

    public function resumeOccupations()
    {
        return $this->hasMany(ResumeOccupation::class);
    }

    public function resumeIndustries()
    {
        return $this->hasMany(ResumeIndustry::class);
    }

    public function resumeRequirementBasic()
    {
        return $this->hasOne(ResumeRequirement::class);
    }

    public function requirementOccupations()
    {
        return $this->belongsToMany(Occupation::class, 'resume_requirement_occupations')->withTimestamps();
    }

    public function requirementIndustries()
    {
        return $this->belongsToMany(Industry::class, 'resume_requirement_industries')->withTimestamps();
    }

    public function requirementLocations()
    {
        return $this->belongsToMany(Location::class, 'resume_requirement_locations')->withTimestamps();
    }

    public function resumeRequirementOccupations()
    {
        return $this->hasMany(ResumeRequirementOccupation::class);
    }

    public function resumeRequirementIndustries()
    {
        return $this->hasMany(ResumeRequirementIndustry::class);
    }

    public function resumeRequirementLocations()
    {
        return $this->hasMany(ResumeRequirementLocation::class);
    }

    public function resumeRequirementEmployments()
    {
        return $this->hasMany(ResumeRequirementEmployment::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}

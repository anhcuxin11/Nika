<?php

namespace App\Models\Relationships;

use App\Models\Feature;
use App\Models\Industry;
use App\Models\Language;
use App\Models\Location;
use App\Models\Occupation;
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
}

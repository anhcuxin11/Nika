<?php

namespace App\Models\Relationships;

use App\Models\Feature;
use App\Models\Industry;
use App\Models\Language;
use App\Models\Location;
use App\Models\Occupation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait JobRelationship
{
    public function industries(): BelongsToMany
    {
        return $this->belongsToMany(Industry::class, 'job_industries')
                    ->withTimestamps();
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'job_locations')
                    ->withTimestamps();
    }

    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(Occupation::class, 'job_occupations')
                    ->withTimestamps();
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'job_features')
                    ->withTimestamps();
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'job_languages')
                    ->withPivot('level')
                    ->withTimestamps();
    }
}

<?php

namespace App\Models\Relationships;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Feature;
use App\Models\Industry;
use App\Models\Language;
use App\Models\Location;
use App\Models\Message;
use App\Models\Occupation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait JobRelationship
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function industries(): BelongsToMany
    {
        return $this->belongsToMany(Industry::class, 'job_industries')
                    ->withTimestamps();
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
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

    public function candidateMessages(): BelongsToMany
    {
        return $this->belongsToMany(Candidate::class, 'messages', 'job_id', 'candidate_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'job_id', 'id');
    }
}

<?php

namespace App\Models\Relationships;

use App\Models\Candidate;
use App\Models\Job;
use App\Models\Message;

trait CompanyRelationship
{
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function markCandidates()
    {
        return $this->belongsToMany(Candidate::class, 'marks', 'company_id', 'candidate_id')
                    ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'company_id', 'id');
    }
}

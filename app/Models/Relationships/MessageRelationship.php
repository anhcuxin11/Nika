<?php

namespace App\Models\Relationships;

use App\Models\Candidate;
use App\Models\Job;

trait MessageRelationship
{
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}

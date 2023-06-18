<?php

namespace App\Models\Relationships;

use App\Models\Job;

trait CompanyRelationship
{
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}

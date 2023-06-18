<?php

namespace App\Models\Relationships;

use App\Models\Resume;

trait ResumeRequirementRelationship
{
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}

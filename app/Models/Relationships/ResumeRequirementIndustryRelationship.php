<?php

namespace App\Models\Relationships;

use App\Models\Industry;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ResumeRequirementIndustryRelationship
{
    public function industry() : BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function resume() : BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}

<?php

namespace App\Models\Relationships;

use App\Models\Occupation;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ResumeRequirementOccupationRelationship
{
    public function occupation() : BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }

    public function resume() : BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}

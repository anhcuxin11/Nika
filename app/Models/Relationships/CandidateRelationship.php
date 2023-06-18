<?php

namespace App\Models\Relationships;

use App\Models\CandidateAttachment;
use App\Models\Favorite;
use App\Models\Resume;

trait CandidateRelationship
{
    public function resume()
    {
        return $this->hasOne(Resume::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function attachment()
    {
        return $this->hasOne(CandidateAttachment::class);
    }
}

<?php
namespace App\Models\Attributes;

trait CandidateAttribute
{
    /**
     * Get the candidate's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->firstname} {$this->lastname}";
    }
}

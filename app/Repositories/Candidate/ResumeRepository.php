<?php

namespace App\Repositories\Candidate;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Collection;

class ResumeRepository
{
    /**
     * Get information by candidate
     *
     * @param int $candidateId
     *
     * @return Collection
     */
    public function getByCandidateId(int $candidateId)
    {
        return Resume::query()
            ->with('industries', 'occupations')
            ->where('id', $candidateId)
            ->first();
    }
}

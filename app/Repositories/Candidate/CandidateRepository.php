<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Collection;

class CandidateRepository
{
    /**
     * Get information by candidate
     *
     * @param array $data
     *
     * @return Collection
     */
    public function update(array $data)
    {
        Candidate::query()
            ->update($data);
    }
}

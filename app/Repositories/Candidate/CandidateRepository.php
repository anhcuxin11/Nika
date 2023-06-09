<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Collection;

class CandidateRepository
{
    /**
     * Get information by candidate
     *
     * @param int $id
     * @param array $data
     *
     * @return Collection
     */
    public function update(int $id, array $data)
    {
        Candidate::query()
            ->where('id', $id)
            ->update($data);
    }

    /**
     * Get by id
     */
    public function getById(int $id, array $relation = [])
    {
        return Candidate::query()
                    ->with($relation)
                    ->where('id', $id)
                    ->first();
    }
}

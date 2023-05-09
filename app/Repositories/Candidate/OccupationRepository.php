<?php

namespace App\Repositories\Candidate;

use App\Models\Occupation;
use Illuminate\Database\Eloquent\Collection;

class OccupationRepository
{
    /**
     * Get all industry
     *
     * @return Collection
     */
    public function getListAndChildren()
    {
        return Occupation::query()
            ->with('childrens')
            ->whereNull('parent_id')
            ->get();
    }
}

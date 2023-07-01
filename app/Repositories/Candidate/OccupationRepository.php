<?php

namespace App\Repositories\Candidate;

use App\Models\Occupation;
use Illuminate\Database\Eloquent\Collection;

class OccupationRepository
{
    /**
     * Get all occupations
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

    /**
     * Get all occupation children
     *
     * @return Collection
     */
    public function getListChildren()
    {
        return Occupation::query()
            ->whereNotNull('parent_id')
            ->get();
    }
}

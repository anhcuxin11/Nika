<?php

namespace App\Repositories\Candidate;

use App\Models\Industry;
use Illuminate\Database\Eloquent\Collection;

class IndustryRepository
{
    /**
     * Get all industry
     *
     * @return Collection
     */
    public function getListAndChildren()
    {
        return Industry::query()
            ->with('childrens')
            ->whereNull('parent_id')
            ->get();
    }
}

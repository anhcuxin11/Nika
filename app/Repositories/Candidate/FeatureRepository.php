<?php

namespace App\Repositories\Candidate;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Collection;

class FeatureRepository
{
    /**
     * Get famous location
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Feature::query()->get();
    }
}

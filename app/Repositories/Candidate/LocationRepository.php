<?php

namespace App\Repositories\Candidate;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository
{
    /**
     * Get famous location
     *
     * @return Collection
     */
    public function getFamousLocation(): Collection
    {
        return Location::query()
                    ->whereIn('id', Location::$famous)
                    ->get();
    }

    public function getListLocation()
    {
        return Location::query()
                    ->get();
    }
}

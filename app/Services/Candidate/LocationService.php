<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\IndustryRepository;
use App\Repositories\Candidate\LocationRepository;
use Illuminate\Database\Eloquent\Collection;

class LocationService
{
    /**
     * @var LocationRepository
     */
    protected $locationRepository;

    /**
     * LocationService constructor.
     *
     * @param LocationRepository $locationRepository
     */
    public function __construct(
        LocationRepository $locationRepository
    ) {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Get all industry
     *
     * @return Collection
     */
    public function getListLocation()
    {
        return $this->locationRepository->getListLocation();
    }
}

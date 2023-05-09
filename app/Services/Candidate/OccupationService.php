<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\OccupationRepository;
use Illuminate\Database\Eloquent\Collection;

class OccupationService
{
    /**
     * @var OccupationRepository
     */
    protected $occupationRepository;

    /**
     * OccupationService constructor.
     *
     * @param OccupationRepository $occupationRepository
     */
    public function __construct(
        OccupationRepository $occupationRepository
    ) {
        $this->occupationRepository = $occupationRepository;
    }

    /**
     * Get all industry
     *
     * @return Collection
     */
    public function getListAndChildren()
    {
        return $this->occupationRepository->getListAndChildren();
    }
}

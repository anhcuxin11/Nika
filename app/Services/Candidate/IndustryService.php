<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\IndustryRepository;
use Illuminate\Database\Eloquent\Collection;

class IndustryService
{
    /**
     * @var IndustryRepository
     */
    protected $industryRepository;

    /**
     * IndustryService constructor.
     *
     * @param IndustryRepository $industryRepository
     */
    public function __construct(
        IndustryRepository $industryRepository
    ) {
        $this->industryRepository = $industryRepository;
    }

    /**
     * Get all industry
     *
     * @return Collection
     */
    public function getListAndChildren()
    {
        return $this->industryRepository->getListAndChildren();
    }
}

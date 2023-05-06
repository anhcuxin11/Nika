<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\JobRepository;

class JobService
{
    /**
     * @var JobRepository
     */
    protected $jobRepository;

        /**
     * JobService constructor.
     *
     * @param JobRepository $jobRepository
     */
    public function __construct(
        JobRepository $jobRepository
    ) {
        $this->jobRepository = $jobRepository;
    }

    /**
     * Get total jobs posted
     *
     * @return int
     */
    public function getCountJob()
    {
        return $this->jobRepository->getCountJob()->count();
    }
}

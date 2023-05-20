<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\FavoriteRepository;
use App\Repositories\Candidate\JobRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class JobService
{
    /**
     * @var JobRepository
     */
    protected $jobRepository;

    /**
     * @var FavoriteRepository
     */
    protected $favoriteRepository;

    /**
     * JobService constructor.
     *
     * @param JobRepository $jobRepository
     * @param FavoriteRepository $favoriteRepository
     */
    public function __construct(
        JobRepository $jobRepository,
        FavoriteRepository $favoriteRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->favoriteRepository = $favoriteRepository;
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

    /**
     * Get all jobs
     *
     * @return LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->jobRepository->getAll();
    }

    /**
     * Get jobs by conditions
     *
     * @param array $data
     *
     * @return LengthAwarePaginator
     */
    public function filter(array $data)
    {
        return $this->jobRepository->filter($data);
    }

    /**
     * List recently viewed jobs
     *
     * @param array $jobIds
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRecentlyViewedJobs(array $jobIds = [])
    {
        return $this->jobRepository->getRecentlyViewedJobs($jobIds);
    }

    /**
     * Get list of favorite jobs
     */
    public function getListFavorites(int $candidateId)
    {
        return $this->favoriteRepository->getListFavorites($candidateId);
    }
}

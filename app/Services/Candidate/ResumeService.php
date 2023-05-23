<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\FeatureRepository;
use App\Repositories\Candidate\JobRepository;
use App\Repositories\Candidate\LanguageRepository;
use App\Repositories\Candidate\LocationRepository;
use App\Repositories\Candidate\ResumeRepository;
use Illuminate\Database\Eloquent\Collection;

class ResumeService
{
    /**
     * @var ResumeRepository
     */
    protected $resumeRepository;


    /**
     * ResumeService constructor.
     *
     * @param ResumeRepository $resumeRepository
     */
    public function __construct(
        ResumeRepository $resumeRepository
    ) {
        $this->resumeRepository = $resumeRepository;
    }

    /**
     * Get information by candidate
     *
     * @param int $candidate
     *
     * @return Collection
     */
    public function getByCandidateId(int $candidateId)
    {
        return $this->resumeRepository->getByCandidateId($candidateId);
    }
}

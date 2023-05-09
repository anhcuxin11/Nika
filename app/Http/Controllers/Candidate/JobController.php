<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\IndustryService;
use App\Services\Candidate\JobService;
use App\Services\Candidate\OccupationService;

class JobController
{
    /**
     * @var JobService
     */
    protected $jobService;

    /**
     * @var IndustryService
     */
    protected $industryService;

    /**
     * @var OccupationService
     */
    protected $occupationService;

    /**
     * @param JobService $jobService
     * @param IndustryService $industryService
     * @param OccupationService $occupationService
     */
    public function __construct(
        JobService $jobService,
        IndustryService $industryService,
        OccupationService $occupationService
    )
    {
        $this->jobService = $jobService;
        $this->industryService = $industryService;
        $this->occupationService = $occupationService;
    }

    /**
     * GEt data ib job page
     */
    public function index()
    {
        $jobs = $this->jobService->getAll();
        $industries = $this->industryService->getListAndChildren();
        $occupations = $this->occupationService->getListAndChildren();

        return view('candidate.job.index', compact('jobs', 'industries', 'occupations'));
    }
}

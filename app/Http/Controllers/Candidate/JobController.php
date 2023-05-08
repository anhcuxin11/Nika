<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\JobService;

class JobController
{
    /**
     * @var JobService
     */
    protected $jobService;

    /**
     * @param JobService $jobService
     */
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * GEt data ib job page
     */
    public function index()
    {
        $jobs = $this->jobService->getAll();

        return view('candidate.job.index', compact('jobs'));
    }
}

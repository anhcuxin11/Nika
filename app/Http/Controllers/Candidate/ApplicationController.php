<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\JobService;

class ApplicationController
{
    /**
     * @var JobService
     */
    protected $jobService;

    /**
     * @param JobService $jobService
     */
    public function __construct(
        JobService $jobService,
    )
    {
        $this->jobService = $jobService;
    }

    /**
     * Get information by candidate
     */
    public function index()
    {

    }
}

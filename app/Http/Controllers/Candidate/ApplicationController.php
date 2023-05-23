<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\JobService;
use Illuminate\Http\Request;

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
        JobService $jobService
    )
    {
        $this->jobService = $jobService;
    }

    /**
     * Get information by candidate
     */
    public function index(Request $request)
    {
        $job = $this->jobService->getJobById($request->id);
    }
}

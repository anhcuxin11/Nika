<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\ApplicationService;
use App\Services\Candidate\JobService;
use App\Services\Candidate\ResumeService;
use Illuminate\Http\Request;

class ApplicationController
{
    /**
     * @var JobService
     */
    protected $jobService;

    /**
     * @var ApplicationService
     */
    protected $applicationService;

    /**
     * @var ResumeService
     */
    protected $resumeService;

    /**
     * @param JobService $jobService
     * @param ResumeService $resumeService
     * @param ApplicationService $applicationService
     */
    public function __construct(
        JobService $jobService,
        ResumeService $resumeService,
        ApplicationService $applicationService
    )
    {
        $this->jobService = $jobService;
        $this->resumeService = $resumeService;
        $this->applicationService = $applicationService;
    }

    /**
     * Get information by candidate
     */
    public function index(Request $request)
    {
        $job = $this->jobService->getJobById($request->id);
        $resume = $this->resumeService->getByCandidateId(auth('web')->user()->id);
        $isEmpty = $this->applicationService->getByJobId($request->id, auth('web')->user()->id);

        return view('candidate.applications.create', compact('job', 'resume', 'isEmpty'));
    }

    /**
     *
     */
    public function apply(int $id, Request $request)
    {
        $candidate = auth('web')->user();
        if (optional($candidate->resume)->age == null || optional($candidate->resume)->skill == null) {
            return redirect()->back()->with('msg_error', 'Please provide complete personal information in your curriculum vitae.');
        }

        $result = $this->applicationService->apply($id, $request);

        if ($result) {
            return redirect()->back()->with('msg_success', 'Apply successfully.');
        }

        return redirect()->back()->with('msg_error', 'Apply failed');
    }
}

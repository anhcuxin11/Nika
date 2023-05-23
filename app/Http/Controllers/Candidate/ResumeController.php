<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\JobService;
use App\Services\Candidate\ResumeService;
use Illuminate\Http\Request;

class ResumeController
{
    /**
     * @var ResumeService
     */
    protected $resumeService;

    /**
     * @param ResumeService $resumeService
     */
    public function __construct(
        ResumeService $resumeService
    )
    {
        $this->resumeService = $resumeService;
    }

    /**
     * Get information by candidate
     */
    public function index()
    {
        $resume = $this->resumeService->getByCandidateId(auth('web')->user()->id);

        return view('candidate.resume.index', compact('resume'));
    }
}

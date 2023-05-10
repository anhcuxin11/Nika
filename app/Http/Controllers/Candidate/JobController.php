<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\IndustryService;
use App\Services\Candidate\JobService;
use App\Services\Candidate\OccupationService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
    public function index(Request $request)
    {
        // dd(Arr::flatten($request->occupation));
        $jobs = $this->jobService->filter($request->all());
        // $jobs = $this->jobService->getAll();
        $industries = $this->industryService->getListAndChildren();
        $occupations = $this->occupationService->getListAndChildren();

        return view('candidate.job.index', compact('jobs', 'industries', 'occupations'));
    }
}

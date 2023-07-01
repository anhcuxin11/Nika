<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\IndustryService;
use App\Services\Candidate\JobService;
use App\Services\Candidate\OccupationService;
use App\Services\CookieService;
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
     * GEt data in job page
     */
    public function index(Request $request)
    {
        $jobs = $this->jobService->filter($request->all());
        $favorites = auth('web')->check() ? $this->jobService->getListFavorites(auth('web')->user()->id) : [];
        $industries = $this->industryService->getListAndChildren();
        $occupations = $this->occupationService->getListAndChildren();

        //job recently viewed
        $ip = str_replace('.', '', $request->ip());
        $jobRecentlyViewedIds = auth('web')->check()
            ? (new CookieService('jobIds_' . auth('web')->user()->id))->get([])
            : (new CookieService('jobIds_' . $ip))->get([]) ;

        $jobRecents = $this->jobService->getRecentlyViewedJobs($jobRecentlyViewedIds);

        return view('candidate.job.index', compact('jobs', 'favorites', 'industries', 'occupations', 'jobRecents'));
    }

    /**
     * Show job detail
     */
    public function show(int $id, Request $request)
    {
        $job = $this->jobService->getJobById($id);
        $company = $job->company;

        if (auth('web')->check()) {
            $cookie = new CookieService('jobIds_' . auth('web')->id());
            $jobIds = $cookie->set([$job->id]);

            return response()
                ->view('candidate.job.show', compact('job', 'company'))
                ->withCookie($jobIds);
        }

        $ip = str_replace('.', '', $request->ip());
        $cookie = new CookieService('jobIds_' . $ip);
        $jobIds = $cookie->set([$job->id]);

        return response()
            ->view('candidate.job.show', compact('job', 'company'))
            ->withCookie($jobIds);
    }

    /**
     * Count jobs
     */
    public function countJob(Request $request)
    {
        $countJobs = $this->jobService->countJob($request->all());

        return response(['result' => $countJobs]);
    }
}

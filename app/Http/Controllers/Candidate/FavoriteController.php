<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\FavoriteService;
use App\Services\Candidate\JobService;
use App\Services\CookieService;
use Illuminate\Http\Request;

class FavoriteController
{
    /**
     * @var JobService
     */
    protected $jobService;

    /**
     * @var FavoriteService
     */
    protected $favoriteService;

    /**
     * @param JobService $jobService
     * @param FavoriteService $favoriteService
     */
    public function __construct(
        JobService $jobService,
        FavoriteService $favoriteService
    )
    {
        $this->jobService = $jobService;
        $this->favoriteService = $favoriteService;
    }

    /**
     * Get list of favorite jobs
     */
    public function index(Request $request)
    {
        $favorites = $this->favoriteService->getListfavortieJob();
        $favoritesByLike = $this->favoriteService->getCoutJobByLike(auth('web')->user()->id)->pluck('job_id')->toArray();
        //job recently viewed
        $ip = str_replace('.', '', $request->ip());
        $jobRecentlyViewedIds = auth('web')->check()
            ? (new CookieService('jobIds_' . auth('web')->user()->id))->get([])
            : (new CookieService('jobIds_' . $ip))->get([]) ;

        $jobRecents = $this->jobService->getRecentlyViewedJobs($jobRecentlyViewedIds);

        return view('candidate.favorite.index', compact('favorites', 'jobRecents', 'favoritesByLike'));
    }

    /**
     * Store job to favorites
     */
    public function store(Request $request)
    {
        $favoriteJob = $this->favoriteService->addFavoriteList($request->job_id);

        return $favoriteJob ? redirect()->back()->with('msg_success', 'Added job to favorite list successfully.')
            : redirect()->back()->with('msg_error', 'Added job to favorite list failed.');
    }

    /**
     * Delete job to favorites
     */
    public function delete(Request $request)
    {
        $favoriteJob = $this->favoriteService->deleteFavoriteList($request->job_id);

        return $favoriteJob ? redirect()->back()->with('msg_success', 'Deleted job to favorite list successfully.')
            : redirect()->back()->with('msg_error', 'Deleted job to favorite list failed.');
    }
}

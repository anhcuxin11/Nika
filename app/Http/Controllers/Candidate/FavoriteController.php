<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\FavoriteService;
use App\Services\Candidate\JobService;
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
    public function index()
    {
        $favorites = $this->favoriteService->getListfavortieJob();

        return view('candidate.favorite.index', compact('favorites'));
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

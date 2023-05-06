<?php

namespace App\Http\Controllers\Candidate;

use App\Models\Candidate;
use App\Services\Candidate\HomeService;

class HomeController
{
    /**
     * @var HomeService
     */
    protected $homeService;

    /**
     * @param HomeService $homeService
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * Get data in home page
     */
    public function index()
    {
        $data = $this->homeService->getDataHomePage();

        return view('candidate.home.index', compact('data'));
    }
}

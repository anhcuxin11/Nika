<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\HomeService;
use App\Services\Candidate\ServerService;

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
        resolve(ServerService::class)->increment();

        return view('candidate.home.index', compact('data'));
    }

    /**
     *
     */
    public function checkServer()
    {
        $servers = resolve(ServerService::class)->getList();

        return view('candidate.home.server', compact('servers'));
    }
}

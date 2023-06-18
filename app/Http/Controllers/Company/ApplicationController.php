<?php

namespace App\Http\Controllers\Company;

use App\Services\Company\ApplicationService;
use App\Services\Company\FavoriteService;
use Dingo\Api\Routing\Helpers;

class ApplicationController
{
    use Helpers;

     /**
     * @var ApplicationService
     */
    protected $applicationService;

    /**
     * @param ApplicationService $applicationService
     */
    public function __construct(
        ApplicationService $applicationService
    )
    {
        $this->applicationService = $applicationService;
    }

    /**
     * Get data in home page
     */
    public function index()
    {
        $applications = $this->applicationService->getByCompany();

        return view('company.applications.index', compact('applications'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\OverviewService;
use Illuminate\Http\Request;

class OverviewController
{
    /** @var OverviewService */
    private $overviewService;

    /**
     * @param OverviewService $overviewService
     */
    public function __construct(OverviewService $overviewService)
    {
        $this->overviewService = $overviewService;
    }

    /**
     * Get data in top page
     */
    public function index(Request $request)
    {
        $data = $this->overviewService->overview();

        return view('admin.overview.index', compact('data'));
    }
}

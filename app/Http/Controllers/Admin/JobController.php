<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\JobService;
use Illuminate\Http\Request;

class JobController
{
    /** @var JobService */
    private $JobService;

    /**
     * @param JobService $JobService
     */
    public function __construct(JobService $JobService)
    {
        $this->JobService = $JobService;
    }

    /**
     * Get data in home page
     */
    public function index(Request $request)
    {
        $jobs = $this->JobService->filter($request->all());

        return view('admin.jobs.index', compact('jobs'));
    }

    public function updateStatus(int $id, Request $request)
    {
        $result = $this->JobService->updateStatus($id, $request->all());

        return $result ? response(['result' => true]) : response(['result' => false, 'message' => 'Error']);
    }
}

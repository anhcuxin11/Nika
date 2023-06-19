<?php

namespace App\Http\Controllers\Company;

use App\Services\Company\ApplicationService;
use App\Services\Company\FavoriteService;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

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
    public function index(Request $request)
    {
        $applications = $this->applicationService->getByCompany($request->all());

        return view('company.applications.index', compact('applications'));
    }

    public function updateStatus($id, $status)
    {
        try {
            DB::beginTransaction();
            $this->applicationService->updateStatus($id, $status);

            DB::commit();
            return $this->response
                    ->array(['message' => trans('Update success')]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_APPLICATION_STATUS: ". $e->getMessage());
            return $this->response->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}

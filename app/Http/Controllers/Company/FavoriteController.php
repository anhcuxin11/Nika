<?php

namespace App\Http\Controllers\Company;

use App\Services\Company\FavoriteService;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class FavoriteController
{
    use Helpers;

     /**
     * @var FavoriteService
     */
    protected $favoriteService;

    /**
     * @param FavoriteService $favoriteService
     */
    public function __construct(
        FavoriteService $favoriteService
    )
    {
        $this->favoriteService = $favoriteService;
    }

    /**
     * Get data in home page
     */
    public function index(Request $request)
    {
        $activeTab = $request->query('tab') ?? 1;

        if ($activeTab == 1) {
            $favorites = $this->favoriteService->getByCompany($request->all());
        } else {
            $favorites = $this->favoriteService->getByMark();
        }

        return view('company.favorites.index', compact('favorites', 'activeTab'));
    }

    public function updateStatus($id, $status)
    {
        try {
            DB::beginTransaction();
            $this->favoriteService->updateStatus($id, $status);

            DB::commit();
            return $this->response
                    ->array(['message' => 'Update success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_FAVORITE_STATUS: ". $e->getMessage());
            return $this->response->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateMark($id, $status)
    {
        try {
            DB::beginTransaction();
            $this->favoriteService->updateStatus($id, $status, 'mark');

            DB::commit();
            return $this->response
                    ->array(['message' => 'Update success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_FAVORITE_MARK: ". $e->getMessage());
            return $this->response->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}

<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\FavoriteRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FavoriteService
{
    /**
     * @var FavoriteRepository
     */
    protected $favoriteRepository;

    /**
     * FavoriteService constructor.
     *
     * @param FavoriteRepository $favoriteRepository
     */
    public function __construct(
        FavoriteRepository $favoriteRepository
    ) {
        $this->favoriteRepository = $favoriteRepository;
    }

    /**
     * Get list of favorite jobs
     */
    public function getListfavortieJob()
    {
        return $this->favoriteRepository->getListfavortieJob(auth('web')->user()->id);
    }

    /**
     * Store job to favorites
     *
     * @param int $jobId
     */
    public function addFavoriteList(int $jobId)
    {
        try {
            DB::beginTransaction();
                $this->favoriteRepository->addFavoriteList($jobId, auth('web')->user()->id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            Log::error("ERROR_STORE_JOB_TO_FAVORITES: ". $e->getMessage());
            DB::rollBack();

            return false;
        }
    }

    /**
     * Delete job to favorites
     *
     * @param int $jobId
     */
    public function deleteFavoriteList(int $jobId)
    {
        try {
            $favorite = $this->favoriteRepository->getFavoriteByJobId($jobId, auth('web')->user()->id);
            if (!empty($favorite)) {
                DB::beginTransaction();
                    $this->favoriteRepository->deleteFavoriteJob($favorite->id);
                DB::commit();

                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error("ERROR_STORE_JOB_TO_FAVORITES: ". $e->getMessage());
            DB::rollBack();

            return false;
        }
    }
}

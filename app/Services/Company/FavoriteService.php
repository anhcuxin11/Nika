<?php

namespace App\Services\Company;

use App\Repositories\Company\FavoriteRepository;
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

    public function getByCompany(array $data)
    {
        return $this->favoriteRepository->getByCompany($data, auth('company')->user()->id);
    }

    public function updateStatus(int $id, int $status, string $key = 'status')
    {
        $favorite = $this->favoriteRepository->getById($id);
        $favorite->update([$key => $status]);
    }

    public function getByMark()
    {
        return $this->favoriteRepository->getByMark(auth('company')->user()->id);
    }
}

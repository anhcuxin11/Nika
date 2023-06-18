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

    public function getByCompany()
    {
        return $this->favoriteRepository->getByCompany(auth('company')->user()->id);
    }
}

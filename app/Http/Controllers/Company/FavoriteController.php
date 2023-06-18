<?php

namespace App\Http\Controllers\Company;

use App\Services\Company\FavoriteService;
use Dingo\Api\Routing\Helpers;

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
    public function index()
    {
        $favorites = $this->favoriteService->getByCompany();

        return view('company.favorites.index', compact('favorites'));
    }
}

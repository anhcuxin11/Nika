<?php

namespace App\Http\Controllers\Company;

use App\Services\Candidate\HomeService;

class HomeController
{
    /**
     * Get data in home page
     */
    public function index()
    {
        return view('company.home.index');
    }
}

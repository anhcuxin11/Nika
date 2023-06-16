<?php

namespace App\Http\Controllers\Admin;

use App\Services\Candidate\HomeService;

class HomeController
{
    /**
     * Get data in home page
     */
    public function index()
    {
        return view('admin.home.index');
    }
}

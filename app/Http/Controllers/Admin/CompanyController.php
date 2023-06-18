<?php

namespace App\Http\Controllers\Admin;

use App\Models\Candidate;
use App\Services\Admin\CandidateService;
use App\Services\Admin\CompanyService;
use Illuminate\Http\Request;

class CompanyController
{
    /** @var CompanyService */
    private $companyService;

    /**
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Get data in home page
     */
    public function index(Request $request)
    {
        $companies = $this->companyService->filter($request->all());

        return view('admin.companies.index', compact('companies'));
    }

    public function delete(int $id)
    {
        $result = $this->companyService->delete($id);

        return $result ? response(['result' => true]) : response(['result' => false, 'message' => 'Error']);
    }

    public function restore(int $id)
    {
        $result = $this->companyService->restore($id);

        return $result ? response(['result' => true]) : response(['result' => false, 'message' => 'Error']);
    }
}

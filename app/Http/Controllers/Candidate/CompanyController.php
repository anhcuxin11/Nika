<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\CompanyService;

class CompanyController
{
    /**
     * @var CompanyService
     */
    protected $companyService;

    /**
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * show company
     */
    public function show(int $id)
    {
        $company = $this->companyService->getById($id);
        $companies = $this->companyService->getAllExceptId($id);
        $jobs = $company->jobs->skip(0)->take(5);

        return view('candidate.job.company', compact('company', 'companies', 'jobs'));
    }
}

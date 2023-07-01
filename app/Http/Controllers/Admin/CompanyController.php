<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UpdateCompanyRequest;
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

    /**
     * Edit company
     */
    public function edit(int $id)
    {
        $company = $this->companyService->getById($id);

        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update company
     */
    public function update(UpdateCompanyRequest $request, int $id)
    {
        $company = $this->companyService->getById($id);
        $update = $this->companyService->update($company, $request);

        if (!$company || !$update) {
            return redirect()->back()->withInput()
                ->with('msg_error', 'Save company information is failed');
        }

        return redirect()->route('admin.companies')
                ->with('msg_success', 'Save company information is successfull');
    }
}

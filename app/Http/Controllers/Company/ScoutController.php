<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use App\Services\Company\CandidateService;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ScoutController
{
    use Helpers;

    /**
     * @var CandidateService
     */
    protected $candidateService;

    /**
     * @param CandidateService $candidateService
     */
    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function index(Request $request)
    {
        $activeTab = $request->query('tab') ?? 1;

        if ($activeTab == 1) {
            return view('company.scouts.index', compact('activeTab'));
        }

        $candidates = $this->candidateService->mark();
        $candidateIds = $this->candidateService->mark()->pluck('id')->toArray();

        return view('company.scouts.result', compact('candidates', 'activeTab', 'candidateIds'));
    }

    public function result(Request $request)
    {
        $activeTab = $request->query('tab') ?? 1;
        $candidates = $this->candidateService->result($request->all());
        $candidateIds = $this->candidateService->mark()->pluck('id')->toArray();

        return view('company.scouts.result', compact('candidates', 'activeTab', 'candidateIds'));
    }

    public function addMark($id)
    {
        try {
            DB::beginTransaction();
            $companyId = auth('company')->user()->id;
            $company = Company::findOrFail($companyId);
            $company->markCandidates()->syncWithoutDetaching([$id]);

            DB::commit();
            return $this->response
                    ->array(['message' => 'Mark success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_MARK: ". $e->getMessage());
            return $this->response->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function removeMark($id)
    {
        try {
            DB::beginTransaction();
            $companyId = auth('company')->user()->id;
            $company = Company::findOrFail($companyId);
            $company->markCandidates()->detach([$id]);

            DB::commit();
            return $this->response
                    ->array(['message' => 'Remove mark success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_MARK: ". $e->getMessage());
            return $this->response->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}

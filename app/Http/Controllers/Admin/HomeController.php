<?php

namespace App\Http\Controllers\Admin;

use App\Models\Candidate;
use App\Services\Admin\CandidateService;
use Illuminate\Http\Request;

class HomeController
{
    /** @var CandidateService */
    private $candidateService;

    /**
     * @param CandidateService $candidateService
     */
    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    /**
     * Get data in home page
     */
    public function index(Request $request)
    {
        $users = $this->candidateService->filter($request->all());

        return view('admin.user.index', compact('users'));
    }

    public function delete(int $id)
    {
        $result = $this->candidateService->delete($id);

        return $result ? response(['result' => true]) : response(['result' => false, 'message' => 'Error']);
    }

    public function restore(int $id)
    {
        $result = $this->candidateService->restore($id);

        return $result ? response(['result' => true]) : response(['result' => false, 'message' => 'Error']);
    }
}

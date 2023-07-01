<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UpdateCandidateRequest;
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

    /**
     * Edit candidate
     */
    public function edit(int $id)
    {
        $user = $this->candidateService->getById($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update candidate
     */
    public function update(UpdateCandidateRequest $request, int $id)
    {
        $user = $this->candidateService->getById($id);
        $update = $this->candidateService->update($user, $request);

        if (!$user || !$update) {
            return redirect()->back()->withInput()
                ->with('msg_error', 'Save candidate failed');
        }

        return redirect()->route('admin.users')
                ->with('msg_success', 'Save candidate successfull');
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

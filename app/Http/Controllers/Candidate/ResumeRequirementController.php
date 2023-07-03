<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Requests\Candidate\UpdateResumeRequirementRequest;
use App\Services\Candidate\ResumeRequirementService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Dingo\Api\Routing\Helpers;

class ResumeRequirementController
{
    use Helpers;

    /**
     * @var ResumeRequirementService
     */
    protected $resumeRequirementService;

    /**
     * @param ResumeRequirementService $resumeRequirementService
     */
    public function __construct(
        ResumeRequirementService $resumeRequirementService
    )
    {
        $this->resumeRequirementService = $resumeRequirementService;
    }

    /**
     * Get desired job of the candidate
     */
    public function index()
    {
        $resumeRequirement = $this->resumeRequirementService->getResumeRequirement(auth('web')->user()->resume->id);

        return view('candidate.desired.index', compact('resumeRequirement'));
    }

    /**
     * Update desired job of the candidate
     */
    public function update(UpdateResumeRequirementRequest $request)
    {
        $resumeRequirement = $this->resumeRequirementService->updateResumeRequirement($request);

        return $resumeRequirement ? $this->response->array(['message' => 'Update successful'])
                : $this->response->error('Update failed', Response::HTTP_BAD_REQUEST);
    }
}

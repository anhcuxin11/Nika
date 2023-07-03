<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Requests\Candidate\UpdateResumeBasicRequest;
use App\Http\Requests\Candidate\UpdateResumeExperienceRequest;
use App\Services\Candidate\ResumeService;
use Dingo\Api\Routing\Helpers;
use Symfony\Component\HttpFoundation\Response;

class ResumeController
{
    use Helpers;

    /**
     * @var ResumeService
     */
    protected $resumeService;

    /**
     * @param ResumeService $resumeService
     */
    public function __construct(
        ResumeService $resumeService
    )
    {
        $this->resumeService = $resumeService;
    }

    /**
     * Get information by candidate
     */
    public function index()
    {
        $resume = $this->resumeService->getByCandidateId(auth('web')->user()->id);

        return view('candidate.resume.index', compact('resume'));
    }

    /**
     * Edit resume job
     *
     * @param int $id
     */
    public function experience(int $id)
    {
        $job = $this->resumeService->getResumeJob($id);
        return view('candidate.resume.edit-job', compact('job'));
    }

    public function updateExperience(UpdateResumeExperienceRequest $request)
    {
        $resume = $this->resumeService->updateResumeJob($request);

        return $resume ? $this->response->array(['message' => trans('Update successful')])
                : $this->response->error('Update failed', Response::HTTP_BAD_REQUEST);
    }

    public function edit(int $id)
    {
        $resume = $this->resumeService->getResumeJob($id);
        return view('candidate.resume.edit', compact('resume'));
    }

    public function update(UpdateResumeBasicRequest $request)
    {
        $resume = $this->resumeService->updateResume($request);

        return $resume ? $this->response->array(['message' => trans('Update successful')])
                : $this->response->error('Update failed', Response::HTTP_BAD_REQUEST);
    }
}

<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\CandidateRepository;
use App\Repositories\Candidate\FeatureRepository;
use App\Repositories\Candidate\JobRepository;
use App\Repositories\Candidate\LanguageRepository;
use App\Repositories\Candidate\LocationRepository;
use App\Repositories\Candidate\ResumeRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResumeService
{
    /**
     * @var ResumeRepository
     */
    protected $resumeRepository;

    /**
     * @var CandidateRepository
     */
    protected $candidateRepository;

    /**
     * @var AttachmentService
     */
    protected $attachmentService;

    /**
     * ResumeService constructor.
     *
     * @param ResumeRepository $resumeRepository
     * @param AttachmentService $attachmentService
     * @param CandidateRepository $candidateRepository
     */
    public function __construct(
        ResumeRepository $resumeRepository,
        AttachmentService $attachmentService,
        CandidateRepository $candidateRepository
    ) {
        $this->resumeRepository = $resumeRepository;
        $this->attachmentService = $attachmentService;
        $this->candidateRepository = $candidateRepository;
    }

    /**
     * Get information by candidate
     *
     * @param int $candidate
     *
     * @return Collection
     */
    public function getByCandidateId(int $candidateId)
    {
        return $this->resumeRepository->getByCandidateId($candidateId);
    }

    /**
     * get resume job of candidate
     *
     * @param int $resumeId
     * @return mixed
     */
    public function getResumeJob(int $resumeId)
    {
        return $this->resumeRepository->getByCandidateId($resumeId);
    }


    /**
     * Update data resume job
     *
     * @param array $data
     *
     * @return bool
     * @throws GeneralException
     * @throws \Throwable
     */
    public function updateResumeJob(Request $request)
    {
        try {
            DB::beginTransaction();
            $resume = auth('web')->user()->resume;
            $resume->occupations()->sync($request->occupation_ids);
            $resume->industries()->sync($request->industry_ids);
            $this->resumeRepository->updateResume($request->only(['certificate', 'skill', 'current_salary']));
            if ($request->file('attachment')) {
                $this->attachmentService->store($request);
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            log::error("ERROR_UPDATE_RESUME_JOB: ". $e->getMessage());
            DB::rollBack();

            return false;
        }//end try
    }

     /**
     * Update data resume job
     *
     * @param array $data
     *
     * @return bool
     * @throws GeneralException
     * @throws \Throwable
     */
    public function updateResume(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->candidateRepository->update($request->only(['firstname', 'lastname']));
            $this->resumeRepository->updateResumeInfo($request->only(['age', 'phone', 'country', 'address', 'facebook', 'hobby']));
            DB::commit();
            return true;
        } catch (Exception $e) {
            log::error("ERROR_UPDATE_RESUME: ". $e->getMessage());
            DB::rollBack();

            return false;
        }//end try
    }
}

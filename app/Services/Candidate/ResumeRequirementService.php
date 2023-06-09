<?php

namespace App\Services\Candidate;

use App\Http\Requests\Candidate\UpdateResumeRequirementRequest;
use App\Repositories\Candidate\ResumeRequirementEmploymentRepository;
use App\Repositories\Candidate\ResumeRequirementRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResumeRequirementService
{
    /**
     * @var ResumeRequirementRepository
     */
    protected $resumeRequirementRepository;

    /**
     * @var ResumeRequirementEmploymentRepository
     */
    protected $resumeRequirementEmploymentRepository;

    /**
     * DesiredJobService constructor.
     *
     * @param ResumeRequirementRepository $resumeRequirementRepository
     * @param ResumeRequirementEmploymentRepository $resumeRequirementEmploymentRepository
     */
    public function __construct(
        ResumeRequirementRepository $resumeRequirementRepository,
        ResumeRequirementEmploymentRepository $resumeRequirementEmploymentRepository
    ) {
        $this->resumeRequirementRepository = $resumeRequirementRepository;
        $this->resumeRequirementEmploymentRepository = $resumeRequirementEmploymentRepository;
    }

    public function getResumeRequirement(int $resumeId)
    {
        return $this->resumeRequirementRepository->getResumeRequirement($resumeId);
    }

    public function updateResumeRequirement(UpdateResumeRequirementRequest $request)
    {
        try {
            $resume = auth('web')->user()->resume;
            $resume->requirementOccupations()->sync($request->occupation_ids);
            $resume->requirementIndustries()->sync($request->industry_ids);
            $resume->requirementLocations()->sync($request->location_ids);

            //update resume requirement employment
            $requirementEmploymentRemove = array_diff($resume->resumeRequirementEmployments->pluck('requirement_employment')->toArray(), $request->requirementEmployment);
            if (count($requirementEmploymentRemove)) {
                $this->resumeRequirementEmploymentRepository->deleteByRequirementEmployment($resume->id, $requirementEmploymentRemove);
            }
            foreach ($request->requirementEmployment as $requirementEmployment) {
                $this->resumeRequirementEmploymentRepository->updateOrCreate($resume->id, $requirementEmployment);
            }

            $this->resumeRequirementRepository->updateResumeRequirement($resume, $request->only(['requirementSalary']));

            return true;
        } catch (Exception $e) {
            Log::error("ERROR_UPDATE_RESUME_REQUIREMENT: ". $e->getMessage());
            DB::rollBack();
            return false;
        }//end try
    }
}

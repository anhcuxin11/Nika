<?php

namespace App\Repositories\Candidate;

use App\Models\ResumeRequirementEmployment;

class ResumeRequirementEmploymentRepository
{
    /**
     * Update or create.
     *
     * @param int $resumeId
     * @param int $requirementEmployment
     */
    public function updateOrCreate(int $resumeId, int $requirementEmployment)
    {
        return ResumeRequirementEmployment::query()->updateOrCreate([
                'resume_id' => $resumeId,
                'requirement_employment' => $requirementEmployment
            ]);
    }

    /**
     * Delete resume requirement employment data
     *
     * @param int $resumeId
     * @param array $requirementEmployments
     */
    public function deleteByRequirementEmployment(int $resumeId, array $requirementEmployments)
    {
        return ResumeRequirementEmployment::query()
            ->where('resume_id', $resumeId)
            ->whereIn('requirement_employment', $requirementEmployments)
            ->forceDelete();
    }
}

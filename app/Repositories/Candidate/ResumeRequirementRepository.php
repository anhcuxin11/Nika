<?php

namespace App\Repositories\Candidate;

use App\Models\Resume;
use App\Models\ResumeRequirement;

class ResumeRequirementRepository
{
    public function getResumeRequirement(int $resumeId)
    {
        $resumeRequirement = ResumeRequirement::query()
                    ->with([
                        'resume',
                        'resume.requirementOccupations',
                        'resume.requirementIndustries',
                        'resume.requirementLocations',
                        'resume.resumeRequirementEmployments'
                    ])->where('resume_id', $resumeId)
                    ->first();

        return is_null($resumeRequirement) ? new ResumeRequirement : $resumeRequirement;
    }

    /**
     * update resume requirement of candidate
     *
     * @param Resume $resume
     * @param array $data
     */
    public function updateResumeRequirement(Resume $resume, array $data)
    {
        $resume->resumeRequirementBasic()->updateOrCreate(
            ['resume_id' => $resume->id],
            [
                'requirement_salary' => $data['requirementSalary']
            ]
        );
    }
}

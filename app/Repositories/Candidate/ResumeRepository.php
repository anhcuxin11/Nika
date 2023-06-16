<?php

namespace App\Repositories\Candidate;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Collection;

class ResumeRepository
{
    /**
     * Get information by candidate
     *
     * @param int $candidateId
     *
     * @return Collection
     */
    public function getByCandidateId(int $candidateId)
    {
        return Resume::query()
            ->with('industries', 'occupations', 'candidate')
            ->where('id', $candidateId)
            ->first();
    }

    /**
     * get resume job of candidate
     *
     * @param int $resumeId
     * @return mixed
     */
    public function getResumeJob(int $resumeId)
    {
        return Resume::query()
                ->with(['resumeOccupations', 'resumeIndustries', 'occupations', 'industries'])
                ->getById($resumeId);
    }

    /**
     * @param array $data
     */
    public function updateResume(array $data)
    {
        Resume::query()
            ->update([
                'certificate' => $data['certificate'],
                'skill' => $data['skill'],
                'current_salary' => $data['current_salary'],
            ]);
    }

    /**
     * @param array $data
     */
    public function updateResumeInfo(array $data)
    {
        Resume::query()
            ->update($data);
    }
}

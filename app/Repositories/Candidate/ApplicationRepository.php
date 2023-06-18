<?php

namespace App\Repositories\Candidate;

use App\Models\Application;

class ApplicationRepository
{
    public function create(array $data)
    {
        Application::create($data);
    }

    public function getByJobId(int $jobId, int $candidateId)
    {
        return Application::query()
                    ->where([
                        'job_id' => $jobId,
                        'candidate_id' => $candidateId,
                    ])
                    ->first();
    }
}

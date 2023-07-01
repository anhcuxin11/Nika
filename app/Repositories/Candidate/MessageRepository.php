<?php

namespace App\Repositories\Candidate;

use App\Models\Language;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository
{
    /**
     * Get messages by jobId
     */
    public function getByJobId(int $candidateId, int $jobId)
    {
        return Message::query()
                    ->where([
                        'candidate_id' => $candidateId,
                        'job_id' => $jobId,
                    ])
                    ->get();
    }

    /**
     * Get messages by jobId
     */
    public function getByCompanyId(int $candidateId, int $companyId)
    {
        return Message::query()
                    ->where([
                        'candidate_id' => $candidateId,
                        'company_id' => $companyId,
                    ])
                    ->whereNull('job_id')
                    ->get();
    }

    /**
     * Store message by jobId
     */
    public function store(int $candidateId, array $data, int $companyId)
    {
        return Message::create([
            'candidate_id' => $candidateId,
            'job_id' => $data['job_id'],
            'company_id' => $companyId,
            'type' => Message::$type['candidate'],
            'text' => $data['content']
        ]);
    }

    /**
     * Store message by companyId
     */
    public function storeCompany(int $candidateId, array $data)
    {
        return Message::create([
            'candidate_id' => $candidateId,
            'company_id' => $data['company_id'],
            'type' => Message::$type['candidate'],
            'text' => $data['content']
        ]);
    }
}

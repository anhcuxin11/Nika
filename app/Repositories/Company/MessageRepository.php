<?php

namespace App\Repositories\Company;

use App\Models\Message;

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
     * Get messages by companyId
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
    public function store(array $data, int $companyId)
    {
        return Message::create([
            'candidate_id' => $data['candidate_id'],
            'job_id' => $data['job_id'],
            'company_id' => $companyId,
            'type' => Message::$type['company'],
            'text' => $data['content']
        ]);
    }

    /**
     * Store Scout message by jobId
     */
    public function storeScout(array $data, int $companyId)
    {
        return Message::create([
            'candidate_id' => $data['candidate_id'],
            'company_id' => $companyId,
            'type' => Message::$type['company'],
            'text' => $data['content']
        ]);
    }

    /**
     *
     */
    public function storeApply(int $candidateId, int $jobId, string $text)
    {
        $companyId = auth('company')->user()->id;

        Message::create([
            'candidate_id' => $candidateId,
            'job_id' => $jobId,
            'company_id' => $companyId,
            'type' => Message::$type['company'],
            'text' => $text
        ]);
    }
}

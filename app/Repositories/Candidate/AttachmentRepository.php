<?php

namespace App\Repositories\Candidate;

use App\Repositories\BaseRepository;
use App\Models\CandidateAttachment;

class AttachmentRepository
{
    /**
     * update resume attachment data
     *
     * @param int $candidateId
     * @param array $data
     */
    public function updateOrCreate(int $candidateId, array $data)
    {
        return CandidateAttachment::query()->updateOrCreate(
            [
                'candidate_id' => $candidateId,
            ],
            [
                'candidate_id' => $candidateId,
                'upload_file_name' => $data['upload_file_name'],
                'upload_file_path' => $data['upload_file_path']
            ]
        );
    }

    /**
     * Get by candidate id
     *
     * @param int $candidateId
     * @param int $type
     *
     * @return CandidateAttachment|null
     */
    public function getByCandidateId(int $candidateId)
    {
        return CandidateAttachment::query()
            ->where('candidate_id', $candidateId)
            ->first();
    }
}

<?php

namespace App\Services\Company;

use App\Models\Candidate;
use App\Repositories\Company\JobRepository;
use App\Repositories\Company\MessageRepository;

class MessageService
{
    /**
     * @var JobRepository
     */
    protected $jobRepository;

    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * MessageService constructor.
     *
     * @param JobRepository $jobRepository
     * @param MessageRepository $messageRepository
     */
    public function __construct(
        JobRepository $jobRepository,
        MessageRepository $messageRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->messageRepository = $messageRepository;
    }

    public function getByMessage()
    {
        return $this->jobRepository->getByMessage(auth('web')->user()->id);
    }

    public function getByJobId(int $id, int $candidateId)
    {
        $messages = $this->messageRepository->getByJobId($candidateId, $id);
        $job = $this->jobRepository->getById($id);

        return [
            'messages' => $messages,
            'job' => $job,
            'company' => $job->company,
        ];
    }

    public function getByCompanyId(int $id, int $candidateId)
    {
        $messages = $this->messageRepository->getByCompanyId($candidateId, $id);
        $candidate = Candidate::query()->where('id', $candidateId)->first();

        return [
            'messages' => $messages,
            'candidate' => $candidate,
        ];
    }

    public function store(array $data)
    {
        $job = $this->jobRepository->getById($data['job_id']);
        $message = $this->messageRepository->store($data, auth('company')->user()->id);

        return [
            'id' => $message->id,
            'job_id' => $message->job_id,
            'type' => $message->type,
            'text' => $message->text,
            'created_at' => $message->created_at->format('Y/m/d H:i'),
        ];
    }

    public function storeScout(array $data)
    {
        $message = $this->messageRepository->storeScout($data, auth('company')->user()->id);
        $candidate = Candidate::query()->where('id', $data['candidate_id'])->first();

        return [
            'id' => $message->id,
            'candidate_id' => $candidate->id,
            'type' => $message->type,
            'text' => $message->text,
            'created_at' => $message->created_at->format('Y/m/d H:i'),
        ];
    }
}

<?php

namespace App\Services\Candidate;

use App\Models\Company;
use App\Repositories\Candidate\ApplicationRepository;
use App\Repositories\Candidate\CompanyRepository;
use App\Repositories\Candidate\JobRepository;
use App\Repositories\Candidate\MessageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageService
{
    /**
     * @var JobRepository
     */
    protected $jobRepository;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * MessageService constructor.
     *
     * @param JobRepository $jobRepository
     * @param MessageRepository $messageRepository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        JobRepository $jobRepository,
        MessageRepository $messageRepository,
        CompanyRepository $companyRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->messageRepository = $messageRepository;
        $this->companyRepository = $companyRepository;
    }

    public function getByMessage()
    {
        return $this->jobRepository->getByMessage(auth('web')->user()->id);
    }

    public function getByCompanyMessage()
    {
        return $this->companyRepository->getByCompanyMessage(auth('web')->user()->id);
    }

    public function getByJobId(int $id)
    {
        $messages = $this->messageRepository->getByJobId(auth('web')->user()->id, $id);
        $job = $this->jobRepository->getById($id);

        return [
            'messages' => $messages,
            'job' => $job,
            'company' => $job->company,
        ];
    }

    public function getByCompanyId(int $id)
    {
        $messages = $this->messageRepository->getByCompanyId(auth('web')->user()->id, $id);
        $company = Company::query()->where('id', $id)->first();

        return [
            'messages' => $messages,
            'company' => $company,
        ];
    }

    public function store(array $data)
    {
        $job = $this->jobRepository->getById($data['job_id']);
        $message = $this->messageRepository->store(auth('web')->user()->id, $data, $job->company_id);

        return [
            'id' => $message->id,
            'job_id' => $message->job_id,
            'type' => $message->type,
            'text' => $message->text,
            'created_at' => $message->created_at->format('Y/m/d H:i'),
        ];
    }

    public function storeCompany(array $data)
    {
        $message = $this->messageRepository->storeCompany(auth('web')->user()->id, $data);

        return [
            'id' => $message->id,
            'company_id' => $message->company_id,
            'type' => $message->type,
            'text' => $message->text,
            'created_at' => $message->created_at->format('Y/m/d H:i'),
        ];
    }
}

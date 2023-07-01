<?php

namespace App\Services\Company;

use App\Jobs\Company\ProcessJob;
use App\Models\Application;
use App\Repositories\Company\ApplicationRepository;
use App\Repositories\Company\MessageRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicationService
{
    /**
     * @var ApplicationRepository
     */
    protected $applicationRepository;

    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * ApplicationService constructor.
     *
     * @param ApplicationRepository $applicationRepository
     * @param MessageRepository $messageRepository
     */
    public function __construct(
        ApplicationRepository $applicationRepository,
        MessageRepository $messageRepository
    ) {
        $this->applicationRepository = $applicationRepository;
        $this->messageRepository = $messageRepository;
    }

    public function getByCompany(array $data)
    {
        return $this->applicationRepository->getByCompany($data, auth('company')->user()->id);
    }

    public function updateStatus(int $id, int $status)
    {
        $application = $this->applicationRepository->getById($id);
        $application->update(['status' => $status]);
        if ($status == 1) {
            ProcessJob::dispatch($application->candidate_id, $application->job_id, auth('company')->user()->id);
        }

        $text = $status == 1 ? Application::MESSAGECOMPATILE : Application::MESSAGECOMPATILE;
        $this->messageRepository->storeApply($application->candidate_id, $application->job_id, $text);
    }
}

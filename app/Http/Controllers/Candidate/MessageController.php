<?php

namespace App\Http\Controllers\Candidate;

use App\Services\Candidate\MessageService;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class MessageController
{
    use Helpers;

    /**
     * @var MessageService
     */
    protected $messageService;

    /**
     * @param MessageService $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index(Request $request)
    {
        $activeTab = $request->query('tab') ?? 1;
        if ($activeTab == 1) {
            $jobs = $this->messageService->getByMessage();

            return view('candidate.messages.index', compact('jobs', 'activeTab'));
        } else {
            $companies = $this->messageService->getByCompanyMessage();

            return view('candidate.messages.index', compact('companies', 'activeTab'));
        }

    }

    public function history(int $id)
    {
        $messages = $this->messageService->getByJobId($id);

        return $this->response->array($messages);
    }

    public function historyCompany(int $id)
    {
        $messages = $this->messageService->getByCompanyId($id);

        return $this->response->array($messages);
    }

    public function send(Request $request)
    {
        $message = $this->messageService->store($request->all());

        return $this->response->array(['message' => $message]);
    }

    public function sendCompany(Request $request)
    {
        $message = $this->messageService->storeCompany($request->all());

        return $this->response->array(['message' => $message]);
    }
}

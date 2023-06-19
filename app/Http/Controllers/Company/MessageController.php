<?php

namespace App\Http\Controllers\Company;

use App\Services\Company\MessageService;
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

    public function history(int $id, int $candidateId)
    {
        $messages = $this->messageService->getByJobId($id, $candidateId);

        return $this->response->array($messages);
    }

    public function send(Request $request)
    {
        $message = $this->messageService->store($request->all());

        return $this->response->array(['message' => $message]);
    }

    public function historyScout(int $candidateId)
    {
        $messages = $this->messageService->getByCompanyId(auth('company')->user()->id, $candidateId);

        return $this->response->array($messages);
    }

    public function sendScout(Request $request)
    {
        $message = $this->messageService->storeScout($request->all());

        return $this->response->array(['message' => $message]);
    }
}

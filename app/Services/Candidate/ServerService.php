<?php

namespace App\Services\Candidate;

use App\Models\Server;

class ServerService
{
    public function increment()
    {
        $server = Server::query()->where('name', Server::SERVER_1)->first();
        $server->increment('count');
    }

    public function getList()
    {
        return Server::query()->get();
    }
}

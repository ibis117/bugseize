<?php

namespace Ibis117\Bugseize\Http;

use Illuminate\Support\Facades\Http;

class Client
{
    /**
     * @var string
     */
    private $server;
    /**
     * @var string
     */
    private $token;

    public function __construct(string $server = null, string $token = null)
    {

        $this->server = $server ?? config('bugseize.url');
        $this->token = $token = config('bugseize.token');
    }

    public function report($data, $user = null)
    {
        $data = [
            'user' => $user,
            ...$data
        ];
        $url = trim($this->server, "/") . "/api/exceptions";
        try {
            $promise = Http::async()
                ->timeout(config('bugseize.timeout'))
                ->withHeaders([
                    'X-BugSeize-Key' => $this->token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'User-Agent' => 'BugSeize-Package'])
                ->post($url, $data);
            $promise->wait();
        } catch (\Exception $e) {
            return null;
        }

    }
}

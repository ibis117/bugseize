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

    public function __construct(string $server, string $token)
    {

        $this->server = $server;
        $this->token = $token;
    }

    public function report($data, $user = null)
    {
        $data = array_merge(['user' => $user], $data);

        try {
            return Http::withHeaders([
                'X-BugSeize-Key' => $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => 'BugSeize-Package'
            ])->connectTimeout(15)
                ->post($this->server, $data);
        }catch (\Exception $e){
            return null;
        }

    }
}

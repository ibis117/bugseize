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

    public function __construct(string $server = null , string $token = null)
    {

        $this->server = $server ?? config('bugseize.url');
        $this->token = $token = config('bugseize.token');
    }

    public function report($data, $user = null)
    {
        $data = array_merge(['user' => $user], $data);
        $url = trim($this->server, "/") . "/api/exceptions";
        try {
            return Http::withHeaders([
                'X-BugSeize-Key' => $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => 'BugSeize-Package'])
                ->post($url, $data);
        }catch (\Exception $e){
            dd($e);
            return null;
        }

    }
}

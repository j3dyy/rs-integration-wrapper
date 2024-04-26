<?php
namespace J3dyy\RsIntegrationWrapper;



use J3dyy\RsIntegrationWrapper\Client\IClient;
use J3dyy\RsIntegrationWrapper\Client\IRSResponse;
use J3dyy\RsIntegrationWrapper\Client\RSResponse;

class RS
{

    public function __construct(
        protected IClient $client
    )
    {
    }

    public function authenticate(string $username, string $password): IRSResponse
    {
        $r = $this->client->request('POST','Users/Authenticate',[
            'json' => [
                'USERNAME' => $username,
                'PASSWORD' => $password,
            ]
        ]);

        return RSResponse::from($r);
    }
}
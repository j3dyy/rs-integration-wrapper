<?php

namespace J3dyy\RsIntegrationWrapper\client;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client
{

    protected GuzzleClient $client;

    public function __construct()
    {
        $this->client = new GuzzleClient([
            'base_uri' => 'https://eapi.rs.ge/Users/Authenticat',
        ]);
    }

    public function authenticate(string $username, string $password)
    {
        $r = $this->request('POST','Users/Authenticate', [
            'json' => [
                'USERNAME' => $username,
                'PASSWORD' => $password,
            ]
        ]);

        echo '<pre>';
        var_dump($r->getBody());
        exit();
    }

    public function request(string $method, string $uri, array $options = []): ResponseInterface
    {
        $response = $this->client->request('POST', 'Authenticate', $options);

        return $response;
    }


}
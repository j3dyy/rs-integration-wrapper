<?php

namespace J3dyy\RsIntegrationWrapper\Client;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as GuzzleClient;
class Client implements IClient
{
    protected GuzzleClient  $client;

    public function __construct(?callable $handlerStack = null)
    {
        $stack = HandlerStack::create($handlerStack);
        $this->client = new GuzzleClient([
            'base_uri' => 'https://eapi.rs.ge/',
            'handler' => $stack,
        ]);
    }


    /**
     * @param string $method
     * @param string $endpoint
     * @param array $options
     * @return RSResponse
     * @throws RSIntegrationException
     */
    function request(string $method, string $endpoint, array $options = []): RSResponse
    {
        try {
            return RSResponse::from(
                $this->client->request($method, $endpoint, $options)
            );
        }catch (GuzzleException $exception){
            throw new RSIntegrationException(
                sprintf("cannot communicate to rs service error was: %s",$exception->getMessage()),
                500
            );
        }
    }
}
<?php

namespace J3dyy\RsIntegrationWrapper\Client\Invoice;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use J3dyy\RsIntegrationWrapper\Client\IClient;
use J3dyy\RsIntegrationWrapper\Client\RSResponse;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;

class InvoiceClient implements IClient
{
    protected GuzzleClient $client;

    public function __construct(?callable $handlerStack = null)
    {
        $stack = HandlerStack::create($handlerStack);
        $this->client = new GuzzleClient([
            'base_uri' => 'https://www.revenue.mof.ge/ntosservice/ntosservice.asmx',
            'handler' => $stack,
            'headers' => [
                'Content-Type' => 'text/xml; charset=UTF-8',
            ]
        ]);
    }

    /**
     * @throws RSIntegrationException
     */
    function request(string $method, string $endpoint, array $options = []): RSResponse
    {
        try {
            return RSResponse::from(
                $this->client->request($method, '?op=' . $endpoint, $options), 'invoice'
            );
        } catch (GuzzleException $exception) {
            throw new RSIntegrationException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}

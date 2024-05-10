<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use J3dyy\RsIntegrationWrapper\Client\IClient;
use J3dyy\RsIntegrationWrapper\Client\RSResponse;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;

class WayBillClient implements IClient
{
    protected GuzzleClient  $client;

    public function __construct(?callable $handlerStack = null)
    {
        $stack = HandlerStack::create($handlerStack);
        $this->client = new GuzzleClient([
            'base_uri' => 'https://services.rs.ge/WayBillService/WayBillService.asmx',
            'handler' => $stack,
            'headers' => [
                'Content-Type' => 'text/xml; charset=UTF-8',
//                'SOAPAction' => 'http://tempuri.org/update_service_user'
            ]
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
                $this->client->request($method, '?op='.$endpoint, $options),'wayBill'
            );
        }catch (GuzzleException $exception){
            throw new RSIntegrationException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
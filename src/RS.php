<?php

namespace J3dyy\RsIntegrationWrapper;


use J3dyy\RsIntegrationWrapper\Client\EApiClient;
use J3dyy\RsIntegrationWrapper\Client\IClient;
use J3dyy\RsIntegrationWrapper\Client\IRSResponse;
use J3dyy\RsIntegrationWrapper\Client\RSResponse;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Enum\RSService;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Service\WayBillService;
use J3dyy\RsIntegrationWrapper\Client\WayBill\WayBillClient;
use J3dyy\RsIntegrationWrapper\Client\XDataRS;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;

class RS
{

    public function __construct(
        protected IClient $eApiClient,
        protected IClient $wayBillClient,
        protected IClient $publicRsClient
    )
    {
    }

    /**
     * @return RS
     */
    public static function default(): RS
    {
        return new RS(
            new EApiClient(),
            new WayBillClient(),
            new XDataRS()
        );
    }

    public function getService(RSService $rsService)
    {
        $service = null;
        switch ($rsService){
            case RSService::WAYBILL:
                $service =  new WayBillService(
                    $this->wayBillClient
                );
                break;
            default:
                throw new RsIntegrationException(sprintf("service %s not iplemented", $rsService->value));
        }

        return $service;
    }

    public function authenticate(string $username, string $password): IRSResponse
    {
        return $this->executeEApi('Users/Authenticate', 'POST', [
            'USERNAME' => $username,
            'PASSWORD' => $password,
        ]);
    }

    public function getPublicInfo(string $identCode): IRSResponse
    {
        try {
            return $this->publicRsClient->request('post', 'TaxPayer/RSPublicInfo', [
                'json' => [
                    'IdentCode' => $identCode
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);

        } catch (RSIntegrationException $exception) {
            return new RSResponse(
                [
                    'message' => $exception->getMessage(),
                ],
                $exception->getCode(),
                []
            );
        }
    }

    public function userInfo(string $rsUser, string $token): IRSResponse
    {
        return $this->executeEApi('Org/GetOrgInfoByTin', 'POST', [
            'Tin' => $rsUser
        ], [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type: application/json'
        ]);
    }


    /**
     * @param string $endpoint
     * @param string $method
     * @param array $payload
     * @return IRSResponse
     */
    protected function executeEApi(string $endpoint, string $method = 'GET', array $payload = [], array $headers = []): IRSResponse
    {
        try {
            return $this->eApiClient->request($method, $endpoint, [
                'json' => $payload,
                'headers' => $headers
            ]);

        } catch (RSIntegrationException $exception) {
            return new RSResponse(
                [
                    'message' => $exception->getMessage(),
                ],
                $exception->getCode(),
                []
            );
        }
    }


}

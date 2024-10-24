<?php

namespace J3dyy\RsIntegrationWrapper;


use J3dyy\RsIntegrationWrapper\Client\EApiClient;
use J3dyy\RsIntegrationWrapper\Client\IClient;
use J3dyy\RsIntegrationWrapper\Client\IRSResponse;
use J3dyy\RsIntegrationWrapper\Client\QueryBuilder;
use J3dyy\RsIntegrationWrapper\Client\RSResponse;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Translator;
use J3dyy\RsIntegrationWrapper\Client\WayBill\WayBillClient;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;

class RS
{

    public function __construct(
        protected IClient $eApiClient,
        protected IClient $wayBillClient
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
            new WayBillClient()
        );
    }

    public function authenticate(string $username, string $password): IRSResponse
    {
        return $this->executeEApi('Users/Authenticate', 'POST', [
            'USERNAME' => $username,
            'PASSWORD' => $password,
        ]);
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

    public function checkServiceUser(string $username, string $password)
    {
        $body = Translator::checkServiceUser($username, $password);
        return $this->executeWayBillApi('chek', 'POST', $body);
    }

    public function getServiceUsers(string $username, string $password)
    {
        $body = Translator::getServiceUsers($username, $password);
        return $this->executeWayBillApi('get_service_user', 'POST', $body);
    }

    public function updateServiceUser(
        string  $username,
        string  $password,
        string  $ip,
        string  $name,
        ?string $serviceUser = null,
        ?string $servicePsw = null
    )
    {
        $body = Translator::updateServiceUser($username, $password, $ip, $name, $serviceUser, $servicePsw);
        return $this->executeWayBillApi('update_service_user', 'POST', $body);
    }

    public function getAkcizCodes(string $username, string $password)
    {
        return $this->executeWayBillApi(
            'get_akciz_codes',
            'POST',
            Translator::withCredentials('get_akciz_codes', $username, $password)
        );
    }

    public function getWayBillTypes(string $username, string $password)
    {
        return $this->executeWayBillApi(
            'get_waybill_types',
            'POST',
            Translator::withCredentials('get_waybill_types', $username, $password)
        );
    }

    public function getWayBillUnits(string $username, string $password)
    {
        return $this->executeWayBillApi(
            'get_waybill_units',
            'POST',
            Translator::withCredentials('get_waybill_units', $username, $password)
        );
    }

    public function getWaybillId(string $username, string $password, int $wayBillId)
    {
        return $this->executeWayBillApi(
            'POST',
            Translator::getWayBill($username, $password, $wayBillId)
        );
    }


    public function listSubscribedSellerWaybills(
        QueryBuilder $builder,
    )
    {
        $query = sprintf("<get_waybills  xmlns='http://tempuri.org/'>%s\n</get_waybills>", $builder->getQuery());
        $query = Translator::inject($query);
        return $this->executeWayBillApi('get_waybills', 'POST', $query);
    }

    public function listSubscribedSellerWaybillsEx(
        QueryBuilder $builder,
    )
    {
        $query = sprintf("<get_waybills_ex  xmlns='http://tempuri.org/'>%s\n</get_waybills_ex>", $builder->getQuery());
        $query = Translator::inject($query);
        return $this->executeWayBillApi('get_waybills', 'POST', $query);
    }

    public function listReceivedBuyerWaybills(
        QueryBuilder $builder,
    )
    {
        $query = sprintf("<get_buyer_waybills  xmlns='http://tempuri.org/'>%s\n</get_buyer_waybills>", $builder->getQuery());
        $query = Translator::inject($query);
        return $this->executeWayBillApi('get_buyer_waybills', 'POST', $query);
    }

    public function listReceivedBuyerWaybillsEx(
        QueryBuilder $builder,
    )
    {
        $query = sprintf("<get_buyer_waybills_ex  xmlns='http://tempuri.org/'>%s\n</get_buyer_waybills_ex>", $builder->getQuery());
        $query = Translator::inject($query);
        return $this->executeWayBillApi('get_buyer_waybills_ex', 'POST', $query);
    }



    public function getTransportTypes(string $username, string $password)
    {
        return $this->executeWayBillApi(
            'get_trans_types',
            'POST',
            Translator::withCredentials('get_trans_types', $username, $password)
        );
    }

    public function getWoodTypes(string $username, string $password)
    {
        return $this->executeWayBillApi(
            'get_wood_types',
            'POST',
            Translator::withCredentials('get_wood_types', $username, $password)
        );
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

    /**
     * @param string $endpoint
     * @param string $method
     * @param string $payload
     * @return IRSResponse
     */
    protected function executeWayBillApi(string $endpoint, string $method = 'GET', string $payload = '', array $headers = []): IRSResponse
    {
        try {
            return $this->wayBillClient->request($method, $endpoint, [
                'body' => $payload,
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

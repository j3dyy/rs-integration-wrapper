<?php
namespace J3dyy\RsIntegrationWrapper;



use J3dyy\RsIntegrationWrapper\Client\IClient;
use J3dyy\RsIntegrationWrapper\Client\IRSResponse;
use J3dyy\RsIntegrationWrapper\Client\RSResponse;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Translator;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;

class RS
{

    public function __construct(
        protected IClient $eApiClient,
        protected IClient $wayBillClient
    )
    {
    }

    public function authenticate(string $username, string $password): IRSResponse
    {
        return $this->executeEApi('Users/Authenticate','POST',[
            'USERNAME' => $username,
            'PASSWORD' => $password,
        ]);
    }

    public function userInfo(string $rsUser, string $token): IRSResponse
    {
        return $this->executeEApi('Org/GetOrgInfoByTin','POST',[
            'Tin' => $rsUser
        ], [
            'Authorization' => 'Bearer '.$token,
            'Content-Type: application/json'
        ]);
    }

    public function checkServiceUser(string $username, string $password)
    {
        $body = Translator::checkServiceUser($username,$password);
        return $this->executeWayBillApi('chek_service_user','POST', $body);
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
            return $this->eApiClient->request($method,$endpoint,[
                'json' => $payload,
                'headers' => $headers
            ]);

        }catch (RSIntegrationException $exception){
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
            return $this->wayBillClient->request($method,$endpoint,[
                'body' => $payload,
                'headers' => $headers
            ]);

        }catch (RSIntegrationException $exception){
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
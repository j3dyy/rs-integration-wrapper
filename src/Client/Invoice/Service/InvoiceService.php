<?php

namespace J3dyy\RsIntegrationWrapper\Client\Invoice\Service;

use J3dyy\RsIntegrationWrapper\Client\IClient;
use J3dyy\RsIntegrationWrapper\Client\Invoice\Enum\InvoiceStatus;
use J3dyy\RsIntegrationWrapper\Client\Invoice\InvoiceTranslator;
use J3dyy\RsIntegrationWrapper\Client\IRSResponse;
use J3dyy\RsIntegrationWrapper\Client\RSResponse;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;

class InvoiceService
{
    public function __construct(protected IClient $client)
    {
    }

    public function check(string $username, string $password, ?int $userId = null): IRSResponse
    {
        return $this->executeInvoiceApi(
            'chek',
            'POST',
            InvoiceTranslator::check($username, $password, $userId)
        );
    }

    public function changeInvoiceStatus(
        string $username,
        string $password,
        int $userId,
        int $invId,
        InvoiceStatus $status,
    ): IRSResponse
    {
        return $this->executeInvoiceApi(
            'change_invoice_status',
            'POST',
            InvoiceTranslator::changeInvoiceStatus($username, $password, $userId, $invId, $status)
        );
    }

    protected function executeInvoiceApi(string $endpoint, string $method = 'GET', string $payload = '', array $headers = []): IRSResponse
    {
        try {
            return $this->client->request($method, $endpoint, [
                'body' => $payload,
                'headers' => $headers,
            ]);
        } catch (RSIntegrationException $exception) {
            return new RSResponse(
                ['message' => $exception->getMessage()],
                $exception->getCode(),
                []
            );
        }
    }
}

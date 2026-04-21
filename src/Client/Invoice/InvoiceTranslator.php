<?php

namespace J3dyy\RsIntegrationWrapper\Client\Invoice;

use J3dyy\RsIntegrationWrapper\Client\Invoice\Enum\InvoiceStatus;

class InvoiceTranslator
{
    public static function check(string $username, string $password, ?int $userId = null): string
    {
        return self::inject('
            <chek xmlns="http://tempuri.org/">
                <su>' . $username . '</su>
                <sp>' . $password . '</sp>
                ' . ($userId !== null ? '<user_id>' . $userId . '</user_id>' : '') . '
            </chek>
        ');
    }

    public static function changeInvoiceStatus(
        string $username,
        string $password,
        int $userId,
        int $invId,
        InvoiceStatus $status,
    ): string
    {
        return self::inject('
            <change_invoice_status xmlns="http://tempuri.org/">
                <user_id>' . $userId . '</user_id>
                <inv_id>' . $invId . '</inv_id>
                <status>' . $status->value . '</status>
                <su>' . $username . '</su>
                <sp>' . $password . '</sp>
            </change_invoice_status>
        ');
    }

    public static function inject(string $body): string
    {
        return '
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
            ' . $body . '
            </soap:Body>
        </soap:Envelope>
        ';
    }
}

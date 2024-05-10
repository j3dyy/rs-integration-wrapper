<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill;

class Translator
{

    public static function checkServiceUser(string $username, string $password): string
    {
        return self::inject('
            <chek_service_user xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
			</chek_service_user>
        ');
    }

    private static function inject(string $body)
    {
        return '
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				<soap:Body>
				'.$body.'
				</soap:Body>
		</soap:Envelope>
        ';
    }
}
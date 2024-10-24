<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill;

use J3dyy\RsIntegrationWrapper\Client\WayBill\Enum\WayBillTypes;

/**
 * @description RS Waybill API Soap translator
 */
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

    public static function getServiceUsers(string $username, string $password): string
    {
        return self::inject('
            <get_service_users xmlns="http://tempuri.org/">
				<user_name>' . $username . '</user_name>
				<user_password>' . $password . '</user_password>
			</get_service_users>
        ');
    }


    public static function updateServiceUser(
        string $username,
        string $password,
        string $ip,
        string $name,
        ?string $serviceUser = null,
        ?string $servicePsw = null
    ): string
    {
        if ($serviceUser == null){
            $serviceUser = $username;
        }
        if ($servicePsw == null){
            $servicePsw = $password;
        }

        return self::inject('
            <update_service_user xmlns="http://tempuri.org/">
                <user_name>' .  $serviceUser . '</user_name>
                <user_password>' . $servicePsw . '</user_password>
                <ip>' . $ip . '</ip>
                <name>' . $name . '</name>
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
			</update_service_user>
        ');
    }

    //todo
    public static function saveWayBill(string $username, string $password){
        return self::inject('
        ');
    }

    /**
     * @param string $username
     * @param string $password
     * @param int $wayBillId
     * @return string
     */
    public static function getWayBill(string $username, string $password, int $wayBillId): string{
        return self::inject('
            <get_waybill xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
			</get_waybill>
        ');
    }

    public static function withCredentials(string $method, string $username, string $password): string
    {
        return self::inject('
            <'.$method.' xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
			</'.$method.'>
        ');
    }

    public static function inject(string $body): string
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
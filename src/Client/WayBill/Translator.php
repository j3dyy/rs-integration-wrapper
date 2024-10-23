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

    /**
     * @param string $username service user
     * @param string $password service user password
     * @param string $buyerTin buyer personal number or identification
     * @param array $statuses array<WayBillStatuses> waybill statuses separated by comma ","
     * @param string $carNumber
     * @param string $beginDateStart between the date of shipment of the waybill of lading the beginning
     * @param string $beginDateEnd between the date of shipment of the waybill of lading the end
     * @param string $createdDateStart between waybill creation date
     * @param string $createdDateEnd  between waybill end date
     * @param string $driverTin driver personal number or identification number
     * @param string $deliveryDateStart between the date of delivery the beginning
     * @param string $deliveryDateEnd between the date of delivery the end
     * @param float $fullAmount
     * @param string $waybillNumber waybill number
     * @param string $closeDateStart between close date beginning
     * @param string $closeDateEnd between close date end
     * @param string $userIds service user ids separated by comma
     * @param string $comment
     * @param array|null $wayBillTypes array<WayBillTypes> $wayBillTypes
     * @return string
     */
    public static function listBuyerWaybill(
        string $username,
        string $password,
        ?string $buyerTin = null,
        ?array $statuses = null,
        ?string $carNumber = null,
        ?string $beginDateStart = null,
        ?string $beginDateEnd = null,
        ?string $createdDateStart = null,
        ?string $createdDateEnd = null,
        ?string $driverTin = null,
        ?string $deliveryDateStart = null,
        ?string $deliveryDateEnd = null,
        ?float $fullAmount = null,
        ?string $waybillNumber = null,
        ?string $closeDateStart = null,
        ?string $closeDateEnd = null,
        ?string $userIds = null,
        ?string $comment = null,
        ?array $wayBillTypes = null,
    ): string
    {
        return self::inject('
            <get_buyer_waybills xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
			</get_buyer_waybills>
        ');
    }

    public static function listSellerWaybills(
        string $username,
        string $password,
        int $isConfirmed = 0,
        ?string $buyerTin = null,
        ?array $statuses = null,
        ?string $carNumber = null,
        ?string $beginDateStart = null,
        ?string $beginDateEnd = null,
        ?string $createdDateStart = null,
        ?string $createdDateEnd = null,
        ?string $driverTin = null,
        ?string $deliveryDateStart = null,
        ?string $deliveryDateEnd = null,
        ?float $fullAmount = null,
        ?string $waybillNumber = null,
        ?string $closeDateStart = null,
        ?string $closeDateEnd = null,
        ?string $userIds = null,
        ?string $comment = null,
        ?array $wayBillTypes = null,
    ): string
    {
        return self::inject('
            <get_waybills_ex xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
			</get_waybills_ex>
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

    private static function inject(string $body): string
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
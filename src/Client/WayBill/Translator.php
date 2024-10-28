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

    public static function sendWaybill(string $username, string $password, int $wayBillId): string{
        return self::inject('
            <send_waybill xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
			</send_waybill>
        ');
    }

    public static function confirmWaybill(string $username, string $password, int $wayBillId): string{
        return self::inject('
            <confirm_waybill xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
			</confirm_waybill>
        ');
    }

    public static function confirmWaybillByDate(string $username, string $password, int $wayBillId, string $beginDate): string{
        return self::inject('
            <send_waybill_vd xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
				<begin_date>' . $beginDate . '</begin_date>
			</send_waybill_vd>
        ');
    }


    public static function closeWayBill(string $username, string $password, int $wayBillId): string{
        return self::inject('
            <close_waybill xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
			</close_waybill>
        ');
    }

    public static function closeWaybillByDate(string $username, string $password, int $wayBillId, string $beginDate): string{
        return self::inject('
            <close_waybill_vd xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
				<begin_date>' . $beginDate . '</begin_date>
			</close_waybill_vd>
        ');
    }

    public static function deleteWayBill(string $username, string $password, int $wayBillId): string{
        return self::inject('
            <del_waybill xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
			</del_waybill>
        ');
    }

    public static function refuseWayBill(string $username, string $password, int $wayBillId): string{
        return self::inject('
            <ref_waybill xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
			</ref_waybill>
        ');
    }

    public static function saveWayBillTransporter(
        string $username,
        string $password,
        int $wayBillId,
        string $carNumber,
        string $driverTin,
        int $checkDriverTin,
        string $driverName,
        int $transId,
        string $transTxt,
        string $receptionInfo,
        string $receiverInfo
    ): string{
        return self::inject('
            <save_waybill_transporter xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
				<car_number>' . $carNumber . '</car_number>
				<driver_tin>' . $driverTin . '</driver_tin>
				<chek_driver_tin>' . $checkDriverTin . '</chek_driver_tin>
				<driver_name>' . $driverName . '</driver_name>
				<trans_id>' . $transId . '</trans_id>
				<trans_txt>' . $transTxt . '</trans_txt>
				<reception_info>' . $receptionInfo . '</reception_info>
				<receiver_inf>' . $receiverInfo . '</receiver_inf>
			</save_waybill_transporter>
        ');
    }

    public static function sendWayBillTransporter(
        string $username,
        string $password,
        int $wayBillId,
        string $beginDate,
        string $wayBillNumber
    ): string
    {
        return self::inject('
            <send_waybill_transporter xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
				<begin_date>' . $beginDate . '</begin_date>
				<waybill_number>' . $wayBillNumber . '</waybill_number>
			</send_waybill_transporter>
        ');
    }

    public static function rejectWayBillFromBuyer(
        string $username,
        string $password,
        int $wayBillId,
    )
    {
        return self::inject('
            <reject_waybill xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
			</reject_waybill>
        ');
    }

    public static function closeTransporterWayBill(
        string $username,
        string $password,
        int $wayBillId,
        string $receptionInfo,
        string $receiverInfo,
        string $deliveryDate
    )
    {
        return self::inject('
            <close_waybill_transporter xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
				<reception_info>' . $receptionInfo . '</reception_info>
				<receiver_info>' . $receiverInfo . '</receiver_info>
				<delivery_date>' . $deliveryDate . '</delivery_date>
			</close_waybill_transporter>
        ');
    }

    public static function saveInvoice(
        string $username,
        string $password,
        int $wayBillId,
        string $inInvId,
    )
    {
        return self::inject('
            <save_invoice xmlns="http://tempuri.org/">
				<su>' . $username . '</su>
				<sp>' . $password . '</sp>
				<waybill_id>' . $wayBillId . '</waybill_id>
				<in_inv_id>' . $inInvId . '</in_inv_id>
			</save_invoice>
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
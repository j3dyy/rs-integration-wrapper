<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Service;

use J3dyy\RsIntegrationWrapper\Client\IClient;
use J3dyy\RsIntegrationWrapper\Client\IRSResponse;
use J3dyy\RsIntegrationWrapper\Client\QueryBuilder;
use J3dyy\RsIntegrationWrapper\Client\RSResponse;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Models\WayBill;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Translator;
use J3dyy\RsIntegrationWrapper\Exceptions\RSIntegrationException;

class WayBillService
{

    public function __construct(protected IClient $client)
    {

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

    public function getAkcizCodes(string $username, string $password)
    {
        return $this->executeWayBillApi(
            'get_akciz_codes',
            'POST',
            Translator::withCredentials('get_akciz_codes', $username, $password)
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
            'get_waybill',
            'POST',
            Translator::getWayBill($username, $password, $wayBillId)
        );
    }

    public function saveWayBill(string $username, string $password, WayBill $wayBill)
    {

        return $this->executeWayBillApi(
            'save_waybill',
            'POST',
            Translator::inject('
                <save_waybill xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
                    <waybill> '.$wayBill->transfer().'</waybill>
                </save_waybill>')
        );
    }

    public function saveWayBillTemplate(string $username, string $password, string $vname,WayBill $wayBill)
    {
        return $this->executeWayBillApi(
            'save_waybill_tamplate',
            'POST',
            Translator::inject('
                <save_waybill_tamplate xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
				    <v_name>' . $vname . '</v_name>
                    '.$wayBill->transfer().'
                </save_waybill_tamplate>')
        );
    }

    public function getWayBillTemplates(string $username, string $password)
    {
        return $this->executeWayBillApi(
            'save_waybill_tamplate',
            'POST',
            Translator::inject('
                <get_waybill_tamplates xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
                </get_waybill_tamplates>')
        );
    }

    public function getWayBillTemplate(string $username, string $password, int $templateId)
    {
        return $this->executeWayBillApi(
            'get_waybill_tamplates',
            'POST',
            Translator::inject('
                <get_waybill_tamplate xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
				    <id>' . $templateId . '</id>
                </get_waybill_tamplate>')
        );
    }

    public function deleteWayBillTemplate(string $username, string $password, int $templateId)
    {
        return $this->executeWayBillApi(
            'delete_waybill_tamplate',
            'POST',
            Translator::inject('
                <delete_waybill_tamplate xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
				    <id>' . $templateId . '</id>
                </delete_waybill_tamplate>')
        );
    }

    public function saveBarCode(string $username, string $password, string $barCode, string $goodsName, int $unitId, string $unitTxt, int $aId = 0)
    {
        return $this->executeWayBillApi(
            'save_bar_code',
            'POST',
            Translator::inject('
                <save_bar_code xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
				    <bar_code>' . $barCode . '</bar_code>
				    <goods_name>' . $goodsName . '</goods_name>
				    <unit_id>' . $unitId . '</unit_id>
				    <unit_txt>' . $unitTxt . '</unit_txt>
				    <a_id>' . $aId . '</a_id>
                </save_bar_code>')
        );
    }

    public function deleteBarCode(string $username, string $password, string $barCode)
    {
        return $this->executeWayBillApi(
            'delete_bar_code',
            'POST',
            Translator::inject('
                <delete_bar_code xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
				    <bar_code>' . $barCode . '</bar_code>
                </delete_bar_code>')
        );
    }

    public function getBarCodes(string $username, string $password, string $barCode)
    {
        return $this->executeWayBillApi(
            'get_bar_codes',
            'POST',
            Translator::inject('
                <get_bar_codes xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
				    <bar_code>' . $barCode . '</bar_code>
                </get_bar_codes>')
        );
    }

    public function saveCarNumber(string $username, string $password, string $carNumber)
    {
        return $this->executeWayBillApi(
            'save_car_numbers',
            'POST',
            Translator::inject('
                <save_car_numbers xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
				    <car_number>' . $carNumber . '</car_number>
                </save_car_numbers>')
        );
    }

    public function deleteCarNumber(string $username, string $password, string $carNumber)
    {
        return $this->executeWayBillApi(
            'delete_car_numbers',
            'POST',
            Translator::inject('
                <delete_car_numbers xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
				    <car_number>' . $carNumber . '</car_number>
                </delete_car_numbers>')
        );
    }

    public function getCarNumbers(string $username, string $password)
    {
        return $this->executeWayBillApi(
            'get_car_numbers',
            'POST',
            Translator::inject('
                <get_car_numbers xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
                </get_car_numbers>')
        );
    }

    public function getNameFromTin(string $username, string $password, string $tin)
    {
        return $this->executeWayBillApi(
            'get_name_from_tin',
            'POST',
            Translator::inject('
                <get_name_from_tin xmlns="http://tempuri.org/">
                	<su>' . $username . '</su>
				    <sp>' . $password . '</sp>
				    <tin>' . $tin . '</tin>
                </get_name_from_tin>')
        );
    }


    public function sendWayBill(string $username, string $password, int $wayBillId)
    {
        return $this->executeWayBillApi(
            'send_waybill',
            'POST',
            Translator::sendWaybill($username, $password, $wayBillId)
        );
    }

    public function confirmWaybill(string $username, string $password, int $wayBillId)
    {
        return $this->executeWayBillApi(
            'confirm_waybill',
            'POST',
            Translator::confirmWaybill($username, $password, $wayBillId)
        );
    }

    public function confirmByDateWayBill(
        string $username,
        string $password,
        int $wayBillId,
        string $beginDate,
    )
    {
        return $this->executeWayBillApi(
            'send_waybill_vd',
            'POST',
            Translator::confirmWaybillByDate($username, $password, $wayBillId, $beginDate)
        );
    }

    public function closeWayBill(string $username, string $password, int $wayBillId)
    {
        return $this->executeWayBillApi(
            'close_waybill',
            'POST',
            Translator::closeWayBill($username, $password, $wayBillId)
        );
    }

    public function closeByDateWayBill(
        string $username,
        string $password,
        int $wayBillId,
        string $beginDate,
    )
    {
        return $this->executeWayBillApi(
            'close_waybill_vd',
            'POST',
            Translator::closeWaybillByDate($username, $password, $wayBillId, $beginDate)
        );
    }

    public function deleteWayBill(string $username, string $password, int $wayBillId)
    {
        return $this->executeWayBillApi(
            'del_waybill',
            'POST',
            Translator::deleteWayBill($username, $password, $wayBillId)
        );
    }

    public function refuseWayBill(string $username, string $password, int $wayBillId)
    {
        return $this->executeWayBillApi(
            'ref_waybill',
            'POST',
            Translator::refuseWayBill($username, $password, $wayBillId)
        );
    }


    public function saveWayBillTransporter(
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
    )
    {
        return $this->executeWayBillApi(
            'save_waybill_transporter',
            'POST',
            Translator::saveWayBillTransporter(
                $username,
                $password,
                $wayBillId,
                $carNumber,
                $driverTin,
                $checkDriverTin,
                $driverName,
                $transId,
                $transTxt,
                $receptionInfo,
                $receiverInfo
            )
        );
    }

    public function sendWayBillTransporter(string $username, string $password, int $wayBillId, string $beginDate, string $wayBillNumber)
    {
        return $this->executeWayBillApi(
            'send_waybill_transporter',
            'POST',
            Translator::sendWayBillTransporter(
                $username,
                $password,
                $wayBillId,
                $beginDate,
                $wayBillNumber
            )
        );
    }

    public function rejectWayBillFromBuyer(string $username, string $password, int $wayBillId)
    {
        return $this->executeWayBillApi(
            'reject_waybill',
            'POST',
            Translator::rejectWayBillFromBuyer(
                $username,
                $password,
                $wayBillId,
            )
        );
    }

    public function closeTransporterWayBill(
        string $username,
        string $password,
        int $wayBillId,
        string $receptionInfo,
        string $receiverInfo,
        string $deliveryDate
    )
    {
        return $this->executeWayBillApi(
            'close_waybill_transporter',
            'POST',
            Translator::closeTransporterWayBill(
                $username,
                $password,
                $wayBillId,
                $receptionInfo,
                $receiverInfo,
                $deliveryDate
            )
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

    public function saveInvoice(string $username, string $password, int $wayBillId, int $inInvId)
    {
        return $this->executeWayBillApi(
            'save_invoice',
            'POST',
            Translator::saveInvoice(
                $username,
                $password,
                $wayBillId,
                $inInvId
            )
        );
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

    public function getWayBillTypes(string $username, string $password)
    {
        return $this->executeWayBillApi(
            'get_waybill_types',
            'POST',
            Translator::withCredentials('get_waybill_types', $username, $password)
        );
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

    /**
     * @param string $endpoint
     * @param string $method
     * @param string $payload
     * @param array $headers
     * @return IRSResponse
     */
    protected function executeWayBillApi(string $endpoint, string $method = 'GET', string $payload = '', array $headers = []): IRSResponse
    {
        try {
            return $this->client->request($method, $endpoint, [
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
<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Models;

use J3dyy\RsIntegrationWrapper\Client\WayBill\Enum\CitizenType;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Enum\TransportCostTypes;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Enum\WayBillStatuses;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Enum\WaybillTransportTypes;
use J3dyy\RsIntegrationWrapper\Client\WayBill\Enum\WayBillTypes;

/**
 * waybill representation
 */
class WayBill implements Transferable
{
    /**
     * @var array<WayBill>
     */
    protected array $subWayBill = [];
    /**
     * @var array<Good>
     */
    protected array $goodList = [];
    /**
     * @var array<WoodDocument>
     */
    protected array $woodDocuments = [];
    protected int $id;
    protected WayBillTypes $type;
    protected null|int $buyerTin;
    protected null|int $checkBuyerTin;
    protected null|string $buyerName;
    protected string $startAddress;
    protected string $endAddress;
    protected null|string $driverTin;
    protected null|CitizenType $checkDriverTin;
    protected null|string $driverName;
    protected null|float $transportCoast;
    protected null|string $receptionInfo;
    protected null|string $receiverInfo;
    protected null|string $deliveryDate;
    protected WayBillStatuses $status;
    protected int $sellerUniqueId;
    protected null|int $parId;
    protected float $fullAmount;
    protected null|string $carNumber;
    protected null|string $wayBillNumber;
    protected string $sUserId;
    protected string $beginDate;
    protected TransportCostTypes $tranCostPayer;
    protected WaybillTransportTypes $transId;
    protected null|string $transTxt;
    protected null|string $comment;
    protected int $category;
    protected int $isMed;


    public function __construct(
        WayBillTypes          $type,
        string                $startAddress,
        string                $endAddress,
        WayBillStatuses       $status,
        float                 $fullAmount,
        string                $sUserId,
        string                $beginDate,
        TransportCostTypes    $tranCostPayer,
        WaybillTransportTypes $transId,
        int              $sellerUniqueId,
        int                   $id = 0,
        null|string           $wayBillNumber = null,
        null|string           $carNumber = null,
        null|int              $checkBuyerTin = null,
        null|int              $buyerTin = null,
        null|int              $parId = null,
        null|string           $deliveryDate = null,
        null|float            $transportCoast = null,
        null|string           $driverTin = null,
        null|CitizenType              $checkDriverTin = null,
        null|string           $driverName = null,
        null|string           $receptionInfo = null,
        null|string           $receiverInfo = null,
        null|string           $buyerName = null,
        null|string           $transTxt = null,
        null|string           $comment = null,
        int                   $category = 0,
        int                   $isMed = 0,
        array                 $subWayBill = [],
        array                 $goodList = [],
        array                 $woodDocuments = []
    )
    {
        $this->subWayBill = $subWayBill;
        $this->goodList = $goodList;
        $this->woodDocuments = $woodDocuments;
        $this->id = $id;
        $this->type = $type;
        $this->buyerTin = $buyerTin;
        $this->checkBuyerTin = $checkBuyerTin;
        $this->buyerName = $buyerName;
        $this->startAddress = $startAddress;
        $this->endAddress = $endAddress;
        $this->driverTin = $driverTin;
        $this->checkDriverTin = $checkDriverTin;
        $this->driverName = $driverName;
        $this->transportCoast = $transportCoast;
        $this->receptionInfo = $receptionInfo;
        $this->receiverInfo = $receiverInfo;
        $this->deliveryDate = $deliveryDate;
        $this->status = $status;
        $this->sellerUniqueId = $sellerUniqueId;
        $this->parId = $parId;
        $this->fullAmount = $fullAmount;
        $this->carNumber = $carNumber;
        $this->wayBillNumber = $wayBillNumber;
        $this->sUserId = $sUserId;
        $this->beginDate = $beginDate;
        $this->tranCostPayer = $tranCostPayer;
        $this->transId = $transId;
        $this->transTxt = $transTxt;
        $this->comment = $comment;
        $this->category = $category;
        $this->isMed = $isMed;
    }

    public function getSubWayBill(): array
    {
        return $this->subWayBill;
    }

    public function setSubWayBill(array $subWayBill): void
    {
        $this->subWayBill = $subWayBill;
    }

    public function getGoodList(): array
    {
        return $this->goodList;
    }

    public function setGoodList(array $goodList): void
    {
        $this->goodList = $goodList;
    }

    public function getWoodDocuments(): array
    {
        return $this->woodDocuments;
    }

    public function setWoodDocuments(array $woodDocuments): void
    {
        $this->woodDocuments = $woodDocuments;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getType(): WayBillTypes
    {
        return $this->type;
    }

    public function setType(WayBillTypes $type): void
    {
        $this->type = $type;
    }

    public function getBuyerTin(): ?int
    {
        return $this->buyerTin;
    }

    public function setBuyerTin(?int $buyerTin): void
    {
        $this->buyerTin = $buyerTin;
    }

    public function getCheckBuyerTin(): ?int
    {
        return $this->checkBuyerTin;
    }

    public function setCheckBuyerTin(?int $checkBuyerTin): void
    {
        $this->checkBuyerTin = $checkBuyerTin;
    }

    public function getBuyerName(): ?string
    {
        return $this->buyerName;
    }

    public function setBuyerName(?string $buyerName): void
    {
        $this->buyerName = $buyerName;
    }

    public function getStartAddress(): string
    {
        return $this->startAddress;
    }

    public function setStartAddress(string $startAddress): void
    {
        $this->startAddress = $startAddress;
    }

    public function getEndAddress(): string
    {
        return $this->endAddress;
    }

    public function setEndAddress(string $endAddress): void
    {
        $this->endAddress = $endAddress;
    }

    public function getDriverTin(): ?string
    {
        return $this->driverTin;
    }

    public function setDriverTin(?string $driverTin): void
    {
        $this->driverTin = $driverTin;
    }

    public function getCheckDriverTin(): ?CitizenType
    {
        return $this->checkDriverTin;
    }

    public function setCheckDriverTin(?CitizenType $checkDriverTin): void
    {
        $this->checkDriverTin = $checkDriverTin;
    }

    public function getDriverName(): ?string
    {
        return $this->driverName;
    }

    public function setDriverName(?string $driverName): void
    {
        $this->driverName = $driverName;
    }

    public function getTransportCoast(): ?float
    {
        return $this->transportCoast;
    }

    public function setTransportCoast(?float $transportCoast): void
    {
        $this->transportCoast = $transportCoast;
    }

    public function getReceptionInfo(): ?string
    {
        return $this->receptionInfo;
    }

    public function setReceptionInfo(?string $receptionInfo): void
    {
        $this->receptionInfo = $receptionInfo;
    }

    public function getReceiverInfo(): ?string
    {
        return $this->receiverInfo;
    }

    public function setReceiverInfo(?string $receiverInfo): void
    {
        $this->receiverInfo = $receiverInfo;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?string $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
    }

    public function getStatus(): WayBillStatuses
    {
        return $this->status;
    }

    public function setStatus(WayBillStatuses $status): void
    {
        $this->status = $status;
    }

    public function getSellerUniqueId(): int
    {
        return $this->sellerUniqueId;
    }

    public function setSellerUniqueId(int $sellerUniqueId): void
    {
        $this->sellerUniqueId = $sellerUniqueId;
    }

    public function getParId(): ?int
    {
        return $this->parId;
    }

    public function setParId(?int $parId): void
    {
        $this->parId = $parId;
    }

    public function getFullAmount(): float
    {
        return $this->fullAmount;
    }

    public function setFullAmount(float $fullAmount): void
    {
        $this->fullAmount = $fullAmount;
    }

    public function getCarNumber(): ?string
    {
        return $this->carNumber;
    }

    public function setCarNumber(?string $carNumber): void
    {
        $this->carNumber = $carNumber;
    }

    public function getWayBillNumber(): ?string
    {
        return $this->wayBillNumber;
    }

    public function setWayBillNumber(?string $wayBillNumber): void
    {
        $this->wayBillNumber = $wayBillNumber;
    }

    public function getSUserId(): string
    {
        return $this->sUserId;
    }

    public function setSUserId(string $sUserId): void
    {
        $this->sUserId = $sUserId;
    }

    public function getBeginDate(): string
    {
        return $this->beginDate;
    }

    public function setBeginDate(string $beginDate): void
    {
        $this->beginDate = $beginDate;
    }

    public function getTranCostPayer(): TransportCostTypes
    {
        return $this->tranCostPayer;
    }

    public function setTranCostPayer(TransportCostTypes $tranCostPayer): void
    {
        $this->tranCostPayer = $tranCostPayer;
    }

    public function getTransId(): WaybillTransportTypes
    {
        return $this->transId;
    }

    public function setTransId(WaybillTransportTypes $transId): void
    {
        $this->transId = $transId;
    }

    public function getTransTxt(): ?string
    {
        return $this->transTxt;
    }

    public function setTransTxt(?string $transTxt): void
    {
        $this->transTxt = $transTxt;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function getIsMed(): int
    {
        return $this->isMed;
    }

    public function setIsMed(int $isMed): void
    {
        $this->isMed = $isMed;
    }



    function transfer(): string
    {
        $goods = '';
        $woods = '';
        $subWayBills = '';

        foreach ($this->subWayBill as $subWayBill) {
            $subWayBills .= $subWayBill->transfer();
        }

        foreach ($this->goodList as $good) {
            $goods .= $good->transfer();
        }

        foreach ($this->woodDocuments as $woodDocument) {
            $woods .= $woodDocument->transfer();
        }

        return '
            <WAYBILL>
                <SUB_WAYBILLS>' . $subWayBills . '</SUB_WAYBILLS>
                <GOODS_LIST>
                    ' . $goods . '
                </GOODS_LIST>
                <WOOD_DOCS_LIST>
                    ' . $woods . '
                </WOOD_DOCS_LIST>
                <ID>' . $this->id . '</ID>
                <TYPE>' . $this->type?->value . '</TYPE>
                <BUYER_TIN>' . $this->buyerTin . '</BUYER_TIN>
                <CHEK_BUYER_TIN>' . $this->checkBuyerTin . '</CHEK_BUYER_TIN>
                <BUYER_NAME>' . $this->buyerName . '</BUYER_NAME>
                <START_ADDRESS>' . $this->startAddress . '</START_ADDRESS>
                <END_ADDRESS>' . $this->endAddress . '</END_ADDRESS>
                <DRIVER_TIN>' . $this->driverTin . '</DRIVER_TIN>
                <CHEK_DRIVER_TIN>' . $this->checkDriverTin?->value . '</CHEK_DRIVER_TIN>
                <DRIVER_NAME>' . $this->driverName . '</DRIVER_NAME>
                <TRANSPORT_COAST>' . $this->transportCoast . '</TRANSPORT_COAST>
                <RECEPTION_INFO>' . $this->receptionInfo . '</RECEPTION_INFO>
                <RECEIVER_INFO>' . $this->receiverInfo . '</RECEIVER_INFO>
                <DELIVERY_DATE>' . $this->deliveryDate . '</DELIVERY_DATE>
                <STATUS>' . $this->status?->value . '</STATUS>
                <SELER_UN_ID>' . $this->sellerUniqueId . '</SELER_UN_ID>
                <PAR_ID>' . $this->parId . '</PAR_ID>
                <FULL_AMOUNT>' . $this->fullAmount . '</FULL_AMOUNT>
                <CAR_NUMBER>' . $this->carNumber . '</CAR_NUMBER>
                <WAYBILL_NUMBER>' . $this->wayBillNumber . '</WAYBILL_NUMBER>
                <S_USER_ID>' . $this->sUserId . '</S_USER_ID>
                <BEGIN_DATE>' . $this->beginDate . '</BEGIN_DATE>
                <TRAN_COST_PAYER>' . $this->tranCostPayer?->value . '</TRAN_COST_PAYER>
                <TRANS_ID>' . $this->transId?->value . '</TRANS_ID>
                <TRANS_TXT>' . $this->transTxt . '</TRANS_TXT>
                <COMMENT>' . $this->comment . '</COMMENT>
                <CATEGORY>' . $this->category . '</CATEGORY>
                <IS_MED>' . $this->isMed . '</IS_MED>
            </WAYBILL>
        ';
    }
}
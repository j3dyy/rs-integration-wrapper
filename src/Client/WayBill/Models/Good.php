<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Models;

class Good implements Transferable
{
    protected int $id;
    protected string $wName;
    protected int $unitId;
    protected string $unitTXT;
    protected int $quantity;
    protected float $price;
    protected int $status;
    protected int $amount;
    protected string $barCode;
    protected int $aId;
    protected int $vatType;
    protected string $quantityExt;
    protected string $woodLabel;
    protected int $wId;

    /**
     * @param int $id
     * @param string $wName
     * @param int $unitId
     * @param string $unitTXT
     * @param int $quantity
     * @param float $price
     * @param int $status
     * @param int $amount
     * @param string $barCode
     * @param int $aId
     * @param int $vatType
     * @param string $quantityExt
     * @param string $woodLabel
     * @param int $wId
     */
    public function __construct(
        int $id,
        string $wName,
        int $unitId,
        string $unitTXT,
        int $quantity,
        float $price,
        int $status,
        int $amount,
        string $barCode,
        int $aId,
        int $vatType,
        string $quantityExt = "",
        string $woodLabel = "",
        int $wId = 0)
    {
        $this->id = $id;
        $this->wName = $wName;
        $this->unitId = $unitId;
        $this->unitTXT = $unitTXT;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->status = $status;
        $this->amount = $amount;
        $this->barCode = $barCode;
        $this->aId = $aId;
        $this->vatType = $vatType;
        $this->quantityExt = $quantityExt;
        $this->woodLabel = $woodLabel;
        $this->wId = $wId;
    }


    function transfer(): string
    {
        return '
            <GOODS>
                <ID>'.$this->id.'</ID>
                <W_NAME>'.$this->wName.'</W_NAME>
                <UNIT_ID>'.$this->unitId.'</UNIT_ID>
                <UNIT_TXT>'.$this->unitTXT.'</UNIT_TXT>
                <QUANTITY>'.$this->quantity.'</QUANTITY>
                <PRICE>'.$this->price.'</PRICE>
                <STATUS>'.$this->status.'</STATUS>
                <AMOUNT>'.$this->amount.'</AMOUNT>
                <BAR_CODE>'.$this->barCode.'</BAR_CODE>
                <A_ID>'.$this->aId.'</A_ID>
                <VAT_TYPE>'.$this->vatType.'</VAT_TYPE>
                <QUANTITY_EXT>'.$this->quantityExt.'</QUANTITY_EXT>
                <WOOD_LABEL>'.$this->woodLabel.'</WOOD_LABEL>
                <W_ID>'.$this->wId.'</W_ID>
            </GOODS>
        ';
    }
}
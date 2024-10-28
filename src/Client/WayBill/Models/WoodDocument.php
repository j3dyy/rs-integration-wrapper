<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Models;

class WoodDocument implements Transferable
{
    protected int $id;
    protected string $document;
    protected string $date;
    protected string $description;
    protected int $status;

    public function __construct(int $id, string $document, string $date, string $description, int $status){
        $this->id = $id;
        $this->document = $document;
        $this->date = $date;
        $this->description = $description;
        $this->status = $status;
    }

    function transfer(): string
    {
        return '
        <WOODDOCUMENT>
            <ID>'.$this->id.'</ID>  
            <DOC_N>'.$this->document.'</DOC_N>      
            <DOC_DATE>'.$this->date.'</DOC_DATE>
            <DOC_DESC>'.$this->description.'</DOC_DESC>
            <STATUS>'.$this->status.'</STATUS>
        </WOODDOCUMENT>
        ';
    }
}
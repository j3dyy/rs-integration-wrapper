<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Enum;

enum WayBillTypes: int
{
    case Distribution = 4;
    case SubWayBill = 6;
    case WithTransportation = 2;
    case WithoutTransportation = 3;
    case Return = 5;
    case DomesticShipping = 1;
}
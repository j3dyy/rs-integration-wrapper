<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Enum;

enum WayBillTypes: string
{
    case Distribution = "დისტრიბუცია";
    case SubWayBill = "ქვე-ზედნადები";
    case WithTransportation = "ტრანსპორტირებით";
    case WithoutTransportation = "ტრანსპ. გარეშე";
    case Return = "უკან დაბრუნება";
    case DomesticShipping = "შიდა გადაზიდვა";
}
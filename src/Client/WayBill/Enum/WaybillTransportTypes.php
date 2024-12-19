<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Enum;

enum WaybillTransportTypes: int
{
    case AUTOMOBILE = 1;
    case RAILWAY = 2;
    case AVIATION = 3;
    case OTHER = 4;
    case AUTOMOBILEDIFFERENTCOUNTRY = 6;
    case CARRIER = 7;
    case MOPED = 8;
}
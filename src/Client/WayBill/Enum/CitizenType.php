<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Enum;

use GuzzleHttp\Exception\ClientException;

enum CitizenType: int
{
    case CITIZEN = 1;
    case NOT_CITIZEN = 0;
}
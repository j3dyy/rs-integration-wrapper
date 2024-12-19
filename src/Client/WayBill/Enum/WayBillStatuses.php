<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Enum;

enum WayBillStatuses: int
{
    case Active = 1;
    case Saved = 0;
    case Finished = 2;
}
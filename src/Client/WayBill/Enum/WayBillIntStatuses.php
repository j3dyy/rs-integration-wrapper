<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill\Enum;

enum WayBillStatuses: string
{
    case Active = "აქტიური";
    case Cancelled = "გაუქმებული";
    case Finished = "დასრულებული";
    case ForwardedToTheCarrier = "გადამზიდავთან გადაგზავნილი";
    


}
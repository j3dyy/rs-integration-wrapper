<?php

namespace J3dyy\RsIntegrationWrapper\Client\Invoice\Enum;

enum InvoiceStatus: int
{
    case DELETED = -1;
    case SAVED = 0;
    case SENT = 1;
    case CONFIRMED = 2;
    case CORRECTED_PRIMARY = 3;
    case CORRECTOR = 4;
    case CORRECTOR_SENT = 5;
    case SENT_CANCELLED = 6;
    case CANCELLATION_CONFIRMED = 7;
    case CORRECTION_CONFIRMED = 8;
}

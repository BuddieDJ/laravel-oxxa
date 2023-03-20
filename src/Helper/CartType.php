<?php

namespace App\Integrations\Helper;

enum CartType: string
{
    case RENEW = "RENEW";
    case REGISTER = "REGISTER";
    case TRANSFER = "TRANSFER";
    case OutOfQuarantine = "UIT QUARANTAINE";
}

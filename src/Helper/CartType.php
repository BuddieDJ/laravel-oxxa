<?php

namespace BuddieDJ\Oxxa\Helper;

enum CartType: string
{
    case RENEW = "RENEW";
    case REGISTER = "REGISTER";
    case TRANSFER = "TRANSFER";
    case OutOfQuarantine = "UIT QUARANTAINE";
}

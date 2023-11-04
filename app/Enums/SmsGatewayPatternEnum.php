<?php

namespace App\Enums;

enum SmsGatewayPatternEnum: string
{
    case OTP = "otpMetanext";
    case TICKET="creatorNewTicketMetanext";
    case MASSAGE="responseTicketMetanext";
}

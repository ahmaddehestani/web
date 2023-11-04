<?php

namespace App\Helpers;

use App\Enums\SmsGatewayPatternEnum;
use App\Models\SmsGateway;
use App\Models\UserSms;

class SMSHelper
{
    private string $pattern;
    private array  $parameters;

    public function __construct(SmsGatewayPatternEnum $pattern_key, array $inputs)
    {
        $this->pattern = $pattern_key->value;
        switch ($pattern_key) {
            case SmsGatewayPatternEnum::OTP:
                $this->parameters = [
                    'token' => $inputs[0]
                ];
                break;
            case SmsGatewayPatternEnum::TICKET:
                $this->parameters = [
                    'token'  => $inputs[0],
                    'token2' => $inputs[1],
                ];
                break;
            case SmsGatewayPatternEnum::MASSAGE:
                $this->parameters = [
                    'token'  => $inputs[0],
                    'token2' => $inputs[1],
                    'token3' => $inputs[2],
                ];
                break;
            case SmsGatewayPatternEnum::ADMIN:
                $this->parameters = [
                    'token'  => $inputs[0],
                    'token2' => $inputs[1],

                ];
                break;
        }

    }

//    public function storeSms(User $user, string $pattern, array $inputs = [], SmsGateway $smsGateway = null)
//    {
//        if (!$smsGateway) {
//            $smsGateway = $this->defaultSMSGayeway();
//        }
//        $userSms = new UserSms();
//        $userSms->sms_gateway_id = $smsGateway->id;
//        $userSms->user_id = $user->id;
//        $userSms->pattern = $pattern;
//        $userSms->inputs = $inputs;
//        $userSms->mobile_prefix = $user->mobile_prefix;
//        $userSms->mobile = $user->mobile;
//        $userSms->save();
//        return $userSms;
//    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

}

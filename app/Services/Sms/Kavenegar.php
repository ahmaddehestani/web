<?php

namespace App\Services\Sms;

use Exception;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;

class Kavenegar extends Sms
{
    private string|null $token20 = null;
    private string|null $token10 = null;
    private string|null $token3  = null;
    private string|null $token2  = null;
    private string|null $token;

    private string $api_key;
    private string $sender;
    public string  $gateway_name = 'gateway/sms/kavenegar.name';
    public array   $fields       = [
        'api_key' => 'gateway/sms/Kavenegar.fields.api_key',
        'sender'  => 'gateway/sms/Kavenegar.fields.sender',
    ];

    public function __construct()
    {
        $this->api_key = "645A69513667446B464534507766776344573533475332396D545656364E54457569345534514D687761553D";
    }

    /**
     * send sms kavenegar
     *
     * @param UserSms $userSms
     *
     * @return void
     * @throws Exception
     */
    public function send($userSms): void
    {
        $mobile = $userSms->mobile_prefix . $userSms->mobile;

        try {
            $api = new KavenegarApi($this->api_key);
            $result = $api->Send($this->sender, $mobile, $userSms->note);

            $trace = json_decode($userSms->reference_trace, true);
            $trace[time()] = $result;
            if ($result) {
                $userSms->reference_id = $result[0]->messageid;
                $userSms->reference_status = $result[0]->status;
                $userSms->reference_trace = json_encode($trace);
                $userSms->price = $result[0]->cost;
                $userSms->sender = $result[0]->sender;

                $userSms->status = TableUserSmsFieldStatusEnum::SENDING;

                $userSms->save();
            } else {
                throw new Exception('fail send message to user');
            }
        } catch (ApiException|HttpException $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     * sort inputs by kavenegar template
     * @param array $inputs
     * @return void
     */
    private function sortInputs(array $inputs)
    {
        $this->token = $inputs['token'];
        foreach ($inputs as $key => $input) {
            if ($key == 'token2') {
                $this->token2 = $inputs['token2'];
            }
            if ($key == 'token3') {
                $this->token3 = $inputs['token3'];
            }
            if ($key == 'token10') {
                $this->token10 = $inputs['token10'];
            }
            if ($key == 'token20') {
                $this->token20 = $inputs['token20'];
            }
        }
    }

    /**
     * send sms in kavenegar lookup method
     * @param $userSms
     * @return void
     * @throws Exception
     */
    public function lookup(array $payload)
    {
        $user = $payload['user'];
        $mobile = '+98' . (int)$user->mobile;
        $this->sortInputs($payload['inputs']);
        try {
            $api = new KavenegarApi($this->api_key);
            $api->VerifyLookup(
                $mobile,
                $this->token,
                $this->token2,
                $this->token3,
                $payload['pattern'],
                null,
                $this->token10,
                $this->token20
            );
        } catch (ApiException|HttpException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * get balance kavenegar
     *
     * @param SmsGateway $smsGateway
     *
     * @return float
     */
//    public function balance(SmsGateway $smsGateway): float
//    {
//        return 0;
//    }
}

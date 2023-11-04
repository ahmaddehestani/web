<?php

namespace App\Notifications\Channels;

use App\Models\User;
use App\Services\Sms\Kavenegar;
use Exception as ExceptionAlias;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class KavenegarSmsChannel
{
    /**
     * send sms notify on kavenegar sms channel.
     *
     * @param User         $notifiable
     * @param Notification $notification
     * @throws ExceptionAlias
     */
    public function send(User $notifiable, Notification $notification): void
    {
        $data = $notification->toSms($notifiable);
        $kavenegar = new Kavenegar();
        try {
            $kavenegar->lookup($data);
        } catch (\Exception $exception) {
            Log::info($exception);
            Log::info('Kavenegar lookup exception', $data);
        }


    }

}

<?php

namespace App\Notifications;

use App\Enums\SmsGatewayPatternEnum;
use App\Helpers\SMSHelper;
use App\Notifications\Channels\KavenegarSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTicketNotification extends Notification
{
    use Queueable;
    private SMSHelper $smsHelper;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $data,string $user_name)
    {
        $this->smsHelper = new SMSHelper(SmsGatewayPatternEnum::TICKET, [$data,$user_name]);

    }
    public function via(object $notifiable): array
    {
        return [KavenegarSmsChannel::class];
    }

    public function toSms(object $notifiable)
    {
        return [
            'inputs'  => $this->smsHelper->getParameters(),
            'pattern' => $this->smsHelper->getPattern(),
            'user'    => $notifiable
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

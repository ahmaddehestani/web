<?php

namespace App\Notifications;

use App\Enums\SmsGatewayPatternEnum;
use App\Helpers\SMSHelper;
use App\Notifications\Channels\KavenegarSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserRegisteredNotification extends Notification
{
    use Queueable;

    private SMSHelper $smsHelper;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $code)
    {
        $this->smsHelper = new SMSHelper(SmsGatewayPatternEnum::OTP, [$code]);

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [KavenegarSmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
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

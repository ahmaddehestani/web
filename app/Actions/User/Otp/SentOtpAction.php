<?php

namespace App\Actions\User\Otp;

use App\Models\User;
use App\Models\UserOtp;
use App\Notifications\NewUserRegisteredNotification;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class SentOtpAction
{
    use AsAction;

    public function handle(User $user): array
    {
        $otp = random_int(12345,99999);
        $secret = Str::random(30);
        $user_otp = new UserOtp();
        $user_otp->user_id = $user->id;
        $user_otp->secret = $secret;
        $user_otp->otp = $otp;
        $user_otp->ip_address = request()?->ip();
        $user_otp->save();
        $user->notify(new NewUserRegisteredNotification($otp));
        return [
            'secret' => $secret,
        ];
    }
}

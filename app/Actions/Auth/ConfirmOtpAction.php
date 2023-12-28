<?php

namespace App\Actions\Auth;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserOtp\UserOtpRepositoryInterface;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class ConfirmOtpAction
{
    use AsAction;
public function __construct(
    private readonly UserRepositoryInterface $repository,
    private readonly UserOtpRepositoryInterface $userOtpRepository,
)
{
}

    public function handle($request)
    {
        $userOtp=$this->userOtpRepository->findLatest($request['secret'],'secret');
        if ($userOtp && $userOtp->otp === $request['otp'] && is_null($userOtp->used_at)) {
            $userOtp->user()->update([
                'mobile_verified_at' => Carbon::now(),
            ]);
//            $this->userOtpRepository->update($userOtp,['used_at'=>Carbon::now()]);
            return $userOtp->user->createToken('MyApp')->plainTextToken;
        }
        return false;
    }
}

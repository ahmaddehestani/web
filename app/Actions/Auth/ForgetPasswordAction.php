<?php

namespace App\Actions\Auth;

use App\Actions\User\Otp\SentOtpAction;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class ForgetPasswordAction
{
    use AsAction;
    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    public function handle($request)
    {

        $user=$this->repository->find($request['mobile'],'mobile');

        if ($user) {
            if (isset($user['mobile_verified_at'])) {
                return SentOtpAction::run($user);
            }
            return false;
        }
        return false;
    }
}

<?php

namespace App\Actions\Auth;

use App\Actions\User\Otp\SentOtpAction;
use App\Enums\RoleEnum;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class RegisterAction
{
    use AsAction;

    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    public function handle($request)
    {
        if ($request->input('mobile_prefix', '+98') === '+98') {
            $oldUser = $this->repository->find($request->input('mobile'));
            if (isset($oldUser['mobile_verified_at'])) {
                return trans('auth.registered');
            }
            if (!$oldUser) {
                return DB::transaction(function () use ($request) {


                    /** @var User $user */
                    $user = $this->repository->create([
                        'mobile_prefix' => $request->mobile_prefix,
                        'mobile'        => (int)$request->mobile,
                    ]);
//                    $user->assignRole(RoleEnum::USER->value);
                    $role=Role::where('name',RoleEnum::USER->value)->first();
                    $user->assignRole($role);
                    return SentOtpAction::run($user);

                });
            }

            return SentOtpAction::run($oldUser);
        }
        return trans('auth.prefix_incorrect');
    }
}

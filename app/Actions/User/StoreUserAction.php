<?php

namespace App\Actions\User;

use App\Enums\PermissionEnum;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUserAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepositoryInterface $repository)
    {
    }

    public function handle(array $payload)
    {
        $payload['mobile_verified_at'] = Carbon::now();
        $user=$this->repository->create($payload);
        if(auth()->user()->hasPermissionTo(PermissionEnum::ADMIN->value)){
            $user->syncRoles($payload['roles']);
        }
        return$user;
    }
}

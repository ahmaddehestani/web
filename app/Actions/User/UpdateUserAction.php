<?php

namespace App\Actions\User;

use App\Enums\PermissionEnum;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUserAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepositoryInterface $repository)
    {
    }

    public function handle(User $user, array $payload)
    {
        $this->repository->update($user, $payload);
        if (auth()->user()?->hasPermissionTo(PermissionEnum::ADMIN->value)) {
            $user->syncRoles($payload['roles']);
        }
        return $user;
    }
}

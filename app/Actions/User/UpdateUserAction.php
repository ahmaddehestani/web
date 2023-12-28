<?php

namespace App\Actions\User;

use App\Enums\PermissionEnum;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserCompanyProfile\UserCompanyProfileRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUserAction
{
    use AsAction;

    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly UserCompanyProfileRepositoryInterface $userCompanyProfileRepository
    )
    {
    }

    public function handle(User $user, array $payload)
    {
        return DB::transaction(function () use ($payload,$user) {
        $this->repository->update($user, $payload);
        $this->userCompanyProfileRepository->updateOrCreate($payload,['user_id'=>$user->id]);
        if (auth()->user()?->hasPermissionTo(PermissionEnum::ADMIN->value)) {
            $user->syncRoles($payload['roles']);
        }

        return $user;
        });
    }
}

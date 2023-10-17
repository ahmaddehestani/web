<?php

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteUserAction
{
    use AsAction;

    public function __construct(private readonly UserRepositoryInterface $repository)
    {
    }

    public function handle(User $user)
    {
        return $this->repository->delete($user);
    }
}

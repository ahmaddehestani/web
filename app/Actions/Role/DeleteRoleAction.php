<?php

namespace App\Actions\Role;

use App\Repositories\Role\RoleRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class DeleteRoleAction
{
    use AsAction;
    public function __construct(private readonly RoleRepositoryInterface $repository)
    {
    }

    public function handle(Role $role)
    {
        return $this->repository->delete($role);
    }
}

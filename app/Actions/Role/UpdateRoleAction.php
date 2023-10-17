<?php

namespace App\Actions\Role;

use App\Repositories\Role\RoleRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class UpdateRoleAction
{
    use AsAction;

    public function __construct(private readonly RoleRepositoryInterface $repository)
    {
    }

    public function handle(Role $role,array $payload)
    {
        $model=$this->repository->update($role,$payload);
        return $model->syncPermissions($payload['permissions']);
    }
}

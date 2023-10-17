<?php

namespace App\Actions\Role;

use App\Repositories\Role\RoleRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class StoreRoleAction
{
    use AsAction;
    public function __construct(private readonly RoleRepositoryInterface $repository)
    {
    }

    public function handle(array $payload)
    {
        /** @var Role $model */
        $model=$this->repository->create($payload);
        return $model->syncPermissions($payload['permissions']);
    }
}

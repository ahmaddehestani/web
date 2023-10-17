<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel():Role;
}

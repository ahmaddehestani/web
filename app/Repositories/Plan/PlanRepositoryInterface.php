<?php

namespace App\Repositories\Plan;

use App\Models\Plan;
use App\Repositories\BaseRepositoryInterface;

interface PlanRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Plan;
}

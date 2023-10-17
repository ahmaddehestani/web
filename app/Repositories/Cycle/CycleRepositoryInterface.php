<?php

namespace App\Repositories\Cycle;

use App\Models\Cycle;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface CycleRepositoryInterface extends BaseRepositoryInterface
{
public function getModel(): Cycle;
}

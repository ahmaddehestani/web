<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Category;
}

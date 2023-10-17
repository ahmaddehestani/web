<?php

namespace App\Repositories\Service;

use App\Models\Service;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface ServiceRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Service;
    public function toggleStatus(Service $service): Service;
}

<?php

namespace App\Repositories\Service;

use App\Models\Service;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    public function getModel():Service
    {

        return parent::getModel();
    }

    public function toggleStatus(Service $service): Service
    {
        $service->update(
            ['status'=>!$service->status]
        );
        return $service;
    }
}

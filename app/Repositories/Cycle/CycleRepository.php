<?php

namespace App\Repositories\Cycle;

use App\Models\Cycle;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class CycleRepository extends BaseRepository implements CycleRepositoryInterface
{
public function __construct(Cycle $model)
{
    parent::__construct($model);
}

    public function getModel(): Cycle
    {
        return parent::getModel();
    }

}

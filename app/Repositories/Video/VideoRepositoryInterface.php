<?php

namespace App\Repositories\Video;

use App\Models\Video;
use App\Repositories\BaseRepositoryInterface;


interface VideoRepositoryInterface extends BaseRepositoryInterface
{
public function getModel(): Video;
}

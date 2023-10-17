<?php

namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\BaseRepositoryInterface;

interface MessageRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Message;
}

<?php

namespace App\Actions\Plan;

use App\Models\Plan;
use App\Repositories\Plan\PlanRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StorePlanAction
{
    use AsAction;
    public function __construct(private readonly PlanRepositoryInterface $repository)
    {
    }

    public function handle(array $payload):Plan
    {
        return $this->repository->create($payload);
    }
}

<?php

namespace App\Actions\Plan;

use App\Models\Plan;
use App\Repositories\Plan\PlanRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePlanAction
{
    use AsAction;
public function __construct(private readonly PlanRepositoryInterface $repository)
{
}

    public function handle(Plan $plan,array $payload)
    {
        return $this->repository->update($plan,$payload);
    }
}

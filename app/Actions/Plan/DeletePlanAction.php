<?php

namespace App\Actions\Plan;

use App\Models\Plan;
use App\Repositories\Plan\PlanRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeletePlanAction
{
    use AsAction;
    public function __construct(private readonly PlanRepositoryInterface $repository)
    {
    }

    public function handle(Plan $plan)
    {
        return $this->repository->delete($plan);
    }
}

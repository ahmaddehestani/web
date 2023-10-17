<?php

namespace App\Actions\Cycle;

use App\Models\Cycle;
use App\Models\Plan;
use App\Models\Product;
use App\Repositories\Cycle\CycleRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCycleAction
{
    use AsAction;

    public function __construct(private readonly CycleRepositoryInterface $repository)
    {
    }

    public function handle(Cycle $cycle, array $payload)
    {
        $payload['product_id'] = Product::where('uuid', $payload['product_uuid'])->first()->id;
        $payload['plan_id'] = Plan::where('uuid', $payload['plan_uuid'])->first()->id;
        return $this->repository->update($cycle, $payload);
    }
}

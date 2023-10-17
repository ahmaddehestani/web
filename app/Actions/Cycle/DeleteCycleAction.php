<?php

namespace App\Actions\Cycle;

use App\Models\Cycle;
use App\Repositories\Cycle\CycleRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCycleAction
{
    use AsAction;

    public function __construct(private readonly CycleRepositoryInterface $repository)
    {
    }

    public function handle(Cycle $cycle)
    {
        return $this->repository->delete($cycle);
    }
}

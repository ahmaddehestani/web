<?php

namespace App\Actions\Service;

use App\Models\Service;
use App\Repositories\Service\ServiceRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteServiceAction
{
    use AsAction;
public function __construct(private readonly ServiceRepositoryInterface $repository)
{
}

    public function handle(Service $service)
    {
        return $this->repository->delete($service);
    }
}

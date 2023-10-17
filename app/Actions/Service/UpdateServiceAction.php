<?php

namespace App\Actions\Service;

use App\Models\Cycle;
use App\Models\Service;
use App\Models\User;
use App\Repositories\Service\ServiceRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateServiceAction
{
    use AsAction;
    public function __construct(private readonly ServiceRepositoryInterface $repository)
    {
    }

    public function handle(Service $service,array $payload)
    {
        $payload['user_id'] = User::where('uuid', $payload['user_uuid'])->first()->id;
        $payload['cycle_id'] = Cycle::where('uuid', $payload['cycle_uuid'])->first()->id;
        return $this->repository->update($service, $payload);
    }
}

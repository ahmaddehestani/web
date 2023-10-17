<?php

namespace App\Actions\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProductAction
{
    use AsAction;
    public function __construct(private readonly ProductRepositoryInterface $repository)
    {
    }

    public function handle(array $payload)
    {
        return $this->repository->create($payload);
    }
}

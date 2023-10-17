<?php

namespace App\Actions\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteProductAction
{
    use AsAction;
    public function __construct(private readonly ProductRepositoryInterface $repository)
    {
    }

    public function handle(Product $product)
    {
        return $this->repository->delete($product);
    }
}

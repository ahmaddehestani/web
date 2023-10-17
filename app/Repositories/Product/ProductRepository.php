<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Product
    {
        return parent::getModel();
    }

    public function togglePublished(Product $product): Product
    {
        $product->update(
            ['published'=>!$product->published]
        );
        return $product;
    }
}

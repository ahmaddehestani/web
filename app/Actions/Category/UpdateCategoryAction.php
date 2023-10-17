<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCategoryAction
{
    use AsAction;
    public function __construct(
        private readonly CategoryRepositoryInterface $repository)
    {
    }

    public function handle(Category $category,array $payload)
    {
        return $this->repository->update($category,$payload);
    }
}

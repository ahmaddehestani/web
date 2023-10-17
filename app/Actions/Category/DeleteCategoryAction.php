<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteCategoryAction
{
    use AsAction;
    public function __construct(
        private readonly CategoryRepositoryInterface $repository)
    {
    }
    public function handle(Category $category)
    {
       return $this->repository->delete($category) ;
    }
}

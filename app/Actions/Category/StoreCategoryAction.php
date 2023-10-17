<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCategoryAction
{
    use AsAction;
    public function __construct(
        private readonly CategoryRepositoryInterface $repository)
    {
    }

    public function handle(array $payload):Category
    {
        if(isset($payload['parent_uuid'])){
            $payload['parent_id'] = $this->repository->find($payload['parent_uuid'],'uuid')->id;

        }

        return $this->repository->create($payload);

    }
}

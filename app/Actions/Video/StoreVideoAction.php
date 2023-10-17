<?php

namespace App\Actions\Video;

use App\Models\Category;
use App\Repositories\Video\VideoRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreVideoAction
{
    use AsAction;
    public function __construct(private readonly VideoRepositoryInterface $repository)
    {
    }

    public function handle(array $payload)
    {
        $payload['category_id'] = Category::where('uuid', $payload['category_uuid'])->first()->id;
        return $this->repository->create($payload);
    }
}

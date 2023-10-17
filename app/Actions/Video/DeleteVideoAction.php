<?php

namespace App\Actions\Video;

use App\Models\Video;
use App\Repositories\Video\VideoRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteVideoAction
{
    use AsAction;
public function __construct(private readonly VideoRepositoryInterface $repository)
{
}

    public function handle(Video $video)
    {
        return $this->repository->delete($video);

    }
}

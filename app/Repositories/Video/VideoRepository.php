<?php

namespace App\Repositories\Video;

use App\Models\Video;
use App\Repositories\BaseRepository;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{
    public function __construct(Video $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Video
    {
        return parent::getModel();
    }
}

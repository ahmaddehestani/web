<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Video\DeleteVideoAction;
use App\Actions\Video\StoreVideoAction;
use App\Actions\Video\UpdateVideoAction;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use App\Repositories\Video\VideoRepositoryInterface;
use Illuminate\Http\Request;

class VideoController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Video::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VideoRepositoryInterface $repository)
    {
        $data=$repository->paginate($request->input('page_limit'));
       return $this->resultWithAdditional(VideoResource::collection($data->load('category')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        $model=StoreVideoAction::run($request->validated());
        return $this->successResponse(
            VideoResource::make($model->load('category')),
            trans('video.store_success')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
       return $this->successResponse(VideoResource::make($video->load('category')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        UpdateVideoAction::run($video,$request->validated());
        return $this->successResponse(
            VideoResource::make($video),
            trans('video.update_success')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        DeleteVideoAction::run($video);
        return $this->successResponse(
            VideoResource::make($video),
            trans('video.delete_success')
        );
    }
}

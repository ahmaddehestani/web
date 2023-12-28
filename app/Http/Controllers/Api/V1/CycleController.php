<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Cycle\DeleteCycleAction;
use App\Actions\Cycle\StoreCycleAction;
use App\Actions\Cycle\UpdateCycleAction;
use App\Http\Requests\StoreCycleRequest;
use App\Http\Requests\UpdateCycleRequest;
use App\Http\Resources\CycleResource;
use App\Models\Cycle;
use App\Repositories\Cycle\CycleRepositoryInterface;
use Illuminate\Http\Request;

class CycleController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Cycle::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CycleRepositoryInterface $repository)
    {
        $data = $repository->paginate($request->input('page_limit'));
        return $this->resultWithAdditional(CycleResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCycleRequest $request)
    {
        $model = StoreCycleAction::run($request->validated());
        return $this->successResponse(
            CycleResource::make($model->load('product', 'plan')),
            trans('cycle.store_success')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Cycle $cycle)
    {
        return $this->successResponse(CycleResource::make($cycle->load('product', 'plan')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCycleRequest $request, Cycle $cycle)
    {
       $model=UpdateCycleAction::run($cycle,$request->validated());
        return $this->successResponse(
            CycleResource::make($model),
            trans('cycle.update_success')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cycle $cycle)
    {
        DeleteCycleAction::run($cycle);
        return $this->successResponse(
            $cycle,
            trans('cycle.delete_success')
        );
    }
}

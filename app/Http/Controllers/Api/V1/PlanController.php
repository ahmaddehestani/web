<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Plan\DeletePlanAction;
use App\Actions\Plan\StorePlanAction;
use App\Actions\Plan\UpdatePlanAction;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use App\Repositories\Plan\PlanRepositoryInterface;
use Illuminate\Http\Request;

class PlanController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Plan::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PlanRepositoryInterface $repository)
    {
        $data = $repository->paginate($request->input('page_limit'));
        return $this->resultWithAdditional(PlanResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request)
    {
        $plan = StorePlanAction::run($request->validated());
        return $this->successResponse(
            PlanResource::make($plan),
            trans('plan.store_success')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return $this->successResponse(PlanResource::make($plan));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $model = UpdatePlanAction::run($plan, $request->validated());
        return $this->successResponse(
            PlanResource::make($model),
            trans('plan.update_success')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        DeletePlanAction::run($plan);
        return $this->successResponse(
            PlanResource::make($plan),
            trans('plan.delete_success')
        );
    }
}

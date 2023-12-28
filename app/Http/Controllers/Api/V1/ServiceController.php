<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Service\DeleteServiceAction;
use App\Actions\Service\StoreServiceAction;
use App\Actions\Service\UpdateServiceAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Service::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ServiceRepositoryInterface $repository)
    {
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            if ($role->name === "user") {

                $data = $repository->query()->where('user_id', auth()->user()->id)->paginate();
            } else {
                $data = $repository->paginate($request->input('page_limit'));
            }
        }
        return $this->resultWithAdditional(ServiceResource::collection($data));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $model = StoreServiceAction::run($request->validated());
        return $this->successResponse(
            ServiceResource::make($model->load('cycle', 'user')),
            trans('service.store_success')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return $this->successResponse(ServiceResource::make($service->load('plan', 'user')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $model = UpdateServiceAction::run($service, $request->validated());
        return $this->successResponse(
            ServiceResource::make($model->load('user', 'plan')),
            trans('service.update_success0')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        DeleteServiceAction::run($service);
        return $this->successResponse(
            ServiceResource::make($service),
            trans('service.delete_success')
        );
    }
}

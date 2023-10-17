<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Role\StoreRoleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
//        $this->authorizeResource(Role::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, RoleRepositoryInterface $repository)
    {
        $data =$repository->paginate($request->input('page_limit'));
        return $this->resultWithAdditional(
            RoleResource::collection($data)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role=StoreRoleAction::run($request->validated());
        return $this->successResponse(
            RoleResource::make($role->load('permissions')),
            trans('role.store_success')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
      return $this->successResponse(RoleResource::make($role->load('permissions')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}

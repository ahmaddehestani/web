<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\User\DeleteUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(User::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UserRepositoryInterface $repository)
    {
        $data = $repository->paginate($request->input('page_limit'));
        return $this->resultWithAdditional(UserResource::collection($data));
//        return $this->successResponse(UserResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = StoreUserAction::run($request->validated());
        return $this->successResponse(
            UserResource::make($data),
            trans('user.store_success')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->successResponse(UserResource::make($user->load(['services','tickets'])));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $model = UpdateUserAction::run($user, $request->validated());
        return $this->successResponse(UserResource::make($model),
            trans('user.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DeleteUserAction::run($user);
        return $this->successResponse(UserResource::make($user),
            trans('user.delete_success'));
    }
}

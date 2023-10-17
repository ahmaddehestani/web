<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Message\StoreMessageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Repositories\Message\MessageRepositoryInterface;
use Illuminate\Http\Request;

class MessageController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Message::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, MessageRepositoryInterface $repository)
    {
        $data = $repository->paginate($request->input('page_limit'));
        return $this->successResponse(MessageResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        $data = StoreMessageAction::run($request->validated());
        return $this->successResponse(MessageResource::make($data));
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return $this->successResponse(MessageResource::make($message));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

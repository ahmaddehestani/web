<?php

namespace App\Http\Controllers\Api\V1;


use App\Actions\Ticket\StoreTicketAction;
use App\Enums\RoleEnum;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Ticket::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TicketRepositoryInterface $repository): JsonResponse
    {
        $roles=auth()->user()->roles;
        foreach ($roles as $role){
           if($role->name==="user"){
               $data=$repository->query()->where('user_id',auth()->user()->id)->paginate();
           }else{
               $data = $repository->paginate($request->input('page_limit'));
           }
        }
        return $this->resultWithAdditional(TicketResource::collection($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $data = StoreTicketAction::run($request->validated());
        return $this->successResponse(
            TicketResource::make($data),
            trans('ticket.store_success')
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return $this->successResponse(TicketResource::make($ticket->load('messages','user')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(Ticket $ticket, TicketRepositoryInterface $repository): JsonResponse
    {
        $this->authorize('update', $ticket);
        $data = $repository->toggleStatus($ticket);
        return $this->successResponse(TicketResource::make($data));
    }
}

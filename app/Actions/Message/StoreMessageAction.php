<?php

namespace App\Actions\Message;

use App\Events\NewTicketMessage;
use App\Models\Message;
use App\Models\Ticket;
use App\Repositories\Message\MessageRepositoryInterface;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreMessageAction
{
    use AsAction;

    public function __construct(
        private readonly MessageRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Message
    {
        $payload['user_id'] = auth()->id();
        $payload['ticket_id'] = Ticket::where('key', $payload['key'])->first()->id;
        $model = $this->repository->create($payload);
        event(new NewTicketMessage($model));

        return $model;
    }
}

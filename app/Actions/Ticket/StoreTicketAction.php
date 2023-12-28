<?php

namespace App\Actions\Ticket;

use App\Actions\Message\StoreMessageAction;
use App\Actions\User\Otp\SentNewTicketAction;
use App\Models\Ticket;
use App\Notifications\NewTicketNotification;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreTicketAction
{
    use AsAction;

    public function __construct(
        private readonly TicketRepositoryInterface $repository,
        private readonly StoreMessageAction $storeMessageAction
    )
    {
    }

    public function handle(array $payload): Ticket
    {
        return DB::transaction(function () use ($payload) {
            $payload['user_id'] = auth()->id();
            /** @var Ticket $model */
            $model = $this->repository->create($payload);
            $this->storeMessageAction->handle([
                'key'     => $model->key,
                'message' => $payload['description'],
            ]);

            //todo make event
            $user = auth()->user();
//            if (env('APP_ENV') === 'production') {
//                $user->notify(new NewTicketNotification($model->key, $user->name));
//            }
//            $user->notify(new NewTicketNotification($model->key, $user->name));
            return $model->fresh()->load('messages', 'user');
        });
    }
}

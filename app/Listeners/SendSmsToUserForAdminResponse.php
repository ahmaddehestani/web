<?php

namespace App\Listeners;

use App\Events\NewTicketMessage;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use App\Notifications\TicketResponseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendSmsToUserForAdminResponse implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewTicketMessage $event): void
    {
        if (auth()->id() !== $event->message->ticket->user_id) {
            Log::info("SendSmsToUserResponse");
            $user=User::find($event->message->ticket->user_id);
            $user->notify(new TicketResponseNotification($event->message->ticket->key,$user->name,$event->message->ticket->subject));
        }
    }
}

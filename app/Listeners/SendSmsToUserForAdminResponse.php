<?php

namespace App\Listeners;

use App\Events\NewTicketMessage;
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
            Log::info("SendSmsToUserForAdminResponse");
            //user
            //todo make event to admin
        }
    }
}

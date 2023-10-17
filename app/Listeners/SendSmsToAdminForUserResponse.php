<?php

namespace App\Listeners;

use App\Events\NewTicketMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendSmsToAdminForUserResponse implements ShouldQueue
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
        if (auth()->id()===$event->message->ticket->user_id){
            Log::info("SendSmsToAdminForUserResponse");
            //user
            //todo make event to admin
        }
    }
}

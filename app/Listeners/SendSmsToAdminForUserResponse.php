<?php

namespace App\Listeners;

use App\Events\NewTicketMessage;
use App\Models\User;
use App\Notifications\NewMessageFromUser;
use App\Notifications\TicketResponseNotification;
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
            $user=User::find($event->message->ticket->user_id);
            $user->notify(new NewMessageFromUser($event->message->ticket->key,$user->name,$event->message->ticket->subject));
        }
    }
}

<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TermsUpdated as TermsUpdatedMail;
use App\Events\TermsUpdated as TermsUpdatedEvent;
use App\User;

class SendTermsUpdatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TermsUpdatedEvent $event)
    {
        $users = User::all();
        //This should be improved
        foreach($users as $user){
            Mail::to($user->email)->send(new TermsUpdatedMail($event->term));
        }
    }
}

<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\SendLecenseKey;

class SendLecenseKeyListener
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
    public function handle(SendLecenseKey $event)
    {
        $user = $event->user;
        Mail::send('mail.sendLicenseKey', ['user' => $user], function ($message) use ($user) {
            $message->from(ENV('MAIL_FROM_ADDRESS'), ENV('MAIL_FROM_NAME'));
            $message->subject('Hello ' . $user->name . '!');
            $message->to($user->email);
        });
    }
}

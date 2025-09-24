<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLoginInfoEmail implements ShouldQueue
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
    public function handle(Login $event): void
    {
        $ip    = request()->ip() ?? '-';
        $agent = request()->userAgent() ?? '-';
        $when  = now()->timezone(config('app.timezone'))->toDateTimeString();

        $event->user->notify(new \App\Notifications\LoginInfoNotification($ip, $agent, $when));
    }
}

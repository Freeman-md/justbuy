<?php

namespace App\Listeners;

use App\Events\Subscribed;
use App\Notifications\NewSubscriber as NotificationsNewSubscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewSubscriber
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
     * @param  Subscribed  $event
     * @return void
     */
    public function handle(Subscribed $event)
    {
        notifyAdmin(new NotificationsNewSubscriber($event->subscriber));
    }
}

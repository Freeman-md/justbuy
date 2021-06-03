<?php

namespace App\Listeners;

use App\Events\FeedbackSent;
use App\Notifications\NewFeedback as NotificationsNewFeedback;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewFeedback
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
     * @param  FeedbackSent  $event
     * @return void
     */
    public function handle(FeedbackSent $event)
    {
        notifyAdmin(new NotificationsNewFeedback($event->feedback));
    }
}

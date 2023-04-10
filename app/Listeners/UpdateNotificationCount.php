<?php

namespace App\Listeners;

use App\Events\NotificationAdd;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateNotificationCount
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
     * @param  \App\Events\NotificationAdd  $event
     * @return void
     */
    public function handle(NotificationAdd $event)
    {
        $notificationCount = $event->user->unreadNotifications->count();
dd( $notificationCount);
        // Update the notification count in the navbar for the given user
        view()->share('notificationCount', $notificationCount);

    }
}

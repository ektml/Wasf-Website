<?php

namespace App\Listeners;

use App\Events\WatchUrl;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CountWatch
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
     * @param  \App\Events\WatchUrl  $event
     * @return void
     */
    public function handle(WatchUrl $event)
    {
        $count= $event->data->view;
        $count++;
        $event->data->update([
            'view'=>$count,
        ]);

    }
}

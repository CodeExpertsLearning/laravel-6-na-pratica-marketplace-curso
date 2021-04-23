<?php

namespace App\Listeners;

use App\Events\UserOrderedItems;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRemovingItemsInStock
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
     * @param  UserOrderedItems  $event
     * @return void
     */
    public function handle(UserOrderedItems $event)
    {
        dd($event->test);
    }
}

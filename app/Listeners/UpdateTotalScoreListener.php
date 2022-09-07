<?php

namespace App\Listeners;

use App\Models\Test;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTotalScoreListener
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
    public function handle($event)
    {
        $test = Test::where(["uuid" => $event->request["test_uuid"]])->first();

        $total = $test->total + $event->request["mark"];

        $test->update(["total" => $total]);
    }
}

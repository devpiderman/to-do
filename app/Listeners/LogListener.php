<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Jobs\LogJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogListener
{
    /**
     * Handle the event.
     */
    public function handle(LogEvent $event): void
    {
        dispatch(new LogJob($event->log, $event->method))->onQueue('log');
    }
}

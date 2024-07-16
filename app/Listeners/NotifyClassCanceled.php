<?php

namespace App\Listeners;

use App\Events\ClassCancel;
use App\Events\CLassCanceled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyClassCanceled
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
    public function handle(CLassCanceled $event): void
    {
        $scheduledClass = $event->scheduledClass;
        Log::info($scheduledClass);
    }
}

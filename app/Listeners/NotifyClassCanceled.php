<?php

namespace App\Listeners;

use App\Events\ClassCancel;
use App\Events\CLassCanceled;
use App\Jobs\NotifyClassCanceledJob;
use App\Mail\ClassCanceledMail;
use App\Notifications\ClassCaceledNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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

        $members = $event->scheduledClass->members()->get();

        $className = $event->scheduledClass->classType->name;
        $classDateTime = $event->scheduledClass->date_time;
        $details = compact('className', 'classDateTime');
        // $members->each(function($user) use ($details)
        // {

        //     Mail::to($user)->send(new ClassCanceledMail($details));
        // });
        NotifyClassCanceledJob::dispatch($members, $details);
        //********* search SUPERVISOR */
    }
}

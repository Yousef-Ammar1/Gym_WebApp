<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('app:remind-members', function () {
    $this->comment(Inspiring::quote());
})->dailyAt('12:58');

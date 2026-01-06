<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Inspirational quote command
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Doctor slots generation (updated to daily at 3 AM)
Schedule::command('slots:generate')
    ->dailyAt('03:00')
    ->description('Generate doctor availability slots for next day')
    ->timezone(config('app.timezone', 'UTC')); // Default to UTC if not set
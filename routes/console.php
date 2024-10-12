<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('vaccine:assign-scheduled')
    ->daily()
    ->at('20:00');

Schedule::command('vaccine:send-schedule-mail-to-recipients')
    ->daily()
    ->at('21:00');

Schedule::command('vaccine:update-recipient-status')
    ->daily()
    ->at('19:00');




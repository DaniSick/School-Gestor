<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('sail:clear-all', function () {
    $this->comment('Clearing routes...');
    Artisan::call('route:clear');
    $this->info(Artisan::output());

    $this->comment('Clearing configuration cache...');
    Artisan::call('config:clear');
    $this->info(Artisan::output());

    $this->comment('Clearing views...');
    Artisan::call('view:clear');
    $this->info(Artisan::output());

    $this->comment('Clearing application cache...');
    Artisan::call('cache:clear');
    $this->info(Artisan::output());

    $this->info('All caches cleared successfully!');
})->describe('Clear routes, configuration, views, and application cache in one command.');

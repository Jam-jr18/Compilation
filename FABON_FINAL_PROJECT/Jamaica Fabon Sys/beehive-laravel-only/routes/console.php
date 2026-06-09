<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('beehive:status', function () {
    $this->info('BeeHive Restobar backend is ready.');
})->purpose('Show BeeHive backend status');

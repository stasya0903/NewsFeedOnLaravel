<?php

namespace App\Providers;

use App\Events\EventJobAdded;
use App\QueueStatus;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Queue;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        setlocale(LC_TIME, 'ru_RU.UTF-8');
        /*\Illuminate\Support\Facades\Queue::before(function (JobProcessing $event) {
            if($event->job->getQueue() === 'parsing')
                EventJobAdded::broadcast(Queue::size('parsing'));
            Log::info('before');
            Log::info(Queue::size('parsing'));

        });*/
        \Illuminate\Support\Facades\Queue::after(function (JobProcessed $event) {
            if($event->job->getQueue() === 'parsing')
            EventJobAdded::broadcast(Queue::size('parsing'));


        });

    }
}

<?php

namespace App\Providers;

use App\Events\EventJobAdded;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Queue;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');

    }


}

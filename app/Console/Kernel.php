<?php

namespace App\Console;

use App\Helper\helper_methods;
use App\Models\Point;
use App\Models\Subscriber;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            Subscriber::convertToInactive();
            helper_methods::deleteDir(public_path('temp'));
            // Point::resetDailyProfit();
        // })->everyMinute(); //daily
        })->daily();//daily
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

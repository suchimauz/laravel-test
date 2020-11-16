<?php

namespace App\Console;

use App\Models\User;
use App\Telegram\Handler as Telegram;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
             new Telegram();
        })->cron('* * * * *');

        $schedule->call(function () {
            $totalRequests = 0;
            foreach (User::all()->pluck('id') as $userId) {
                $key = 'api:users:' . $userId;
                if (Cache::has($key)) {
                    $totalRequests += Cache::get($key);
                }

                Cache::put('api-total-requests', $totalRequests);
            }
        })->everyMinute();
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

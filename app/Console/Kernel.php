<?php

namespace App\Console;

use App\Models\Day;
use App\Models\User;
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
        $schedule->command('nullDay:daily')->timezone('America/Toronto')->between('10:12', '10:20');
        // $schedule->command('nullDay:daily')->everyMinute();
        // $schedule->command('nullDay:daily')->everyMinute();
        // $users = User::all();


        // foreach ($users as $user) {
        //     $timezone = $user->timezone;

        //     // $schedule->command('nullDay:daily')->timezone($timezone)->everyMinute();
        //     // $schedule->command('nullDay:daily')->timezone($timezone)->between('23:50', '23:58');
        //     $schedule->command('nullDay:daily')->timezone($timezone)->between('15:53', '15:58');
        // }
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

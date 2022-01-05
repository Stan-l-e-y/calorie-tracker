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
        // $schedule->command('inspire')->hourly();
        // $users = User::all();

        // $schedule->call(function ($users) {
        //     foreach ($users as $user) {
        //         Day::create([
        //             'weight' => 100,
        //             'calories' => 200,
        //             'user_id' => $user->id
        //         ]);
        //     }
        // })->everyMinute();
        $schedule->command('nullDay:daily')->everyMinute();
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

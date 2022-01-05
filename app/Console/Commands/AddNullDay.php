<?php

namespace App\Console\Commands;

use App\Http\Controllers\DaysController;
use App\Models\Day;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddNullDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nullDay:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds null day for today';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {

            $todaysDay = DaysController::isEntryMade($user->id, $user->timezone);

            if (empty($todaysDay[0])) {
                Day::create([
                    'user_id' => $user->id,
                    'created_timezone' => Carbon::now()->setTimezone($user->timezone)
                ]);
            }
        }
    }
}

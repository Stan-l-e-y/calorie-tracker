<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();

        Day::factory(8)->create();
    }
}

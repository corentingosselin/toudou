<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(5)->passwordKnown()->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Project::factory(30)->create();
        \App\Models\Share::factory(40)->create();
        \App\Models\Task::factory(50)->create();


    }
}

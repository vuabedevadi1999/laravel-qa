<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(3)->create()->each(function ($user) {
            $user->questions()->saveMany(\App\Models\Question::factory(rand(1,5))->create(['user_id'=>$user->id])->make());
        });
        // \App\Models\Question::factory(10)->create();
    }
}

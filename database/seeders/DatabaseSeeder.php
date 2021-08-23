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
        $this->call([
            UsersQuestionAnswersSeeder::class,
            FavoritesSeeder::class,
        ]);
        // \App\Models\Question::factory(10)->create();
    }
}

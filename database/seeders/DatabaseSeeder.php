<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Entry;
use App\Models\Question;
use App\Models\Survey;
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
         User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@example.com',
             'password' => bcrypt('admin')
         ]);

        User::factory(20)->create();
        Survey::factory(100)->create();
        Question::factory(300)->create();
        Entry::factory(30)->create();
        Answer::factory(300)->create();
    }
}

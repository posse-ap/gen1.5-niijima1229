<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(LearningContentTableSeeder::class);
        $this->call(LearningLanguageTableSeeder::class);
        $this->call(LanguageLearningRecordTableSeeder::class);
        $this->call(ContentLearningRecordTableSeeder::class);
    }
}

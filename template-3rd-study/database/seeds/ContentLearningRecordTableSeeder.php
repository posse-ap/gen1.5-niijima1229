<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentLearningRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('content_learning_records')->truncate();

        $params = [
            [
                'user_id' => 1,
                'content_id' => 1,
                'learning_date' => '2021-11-21',
                'learning_time' => 2
            ],
            [
                'user_id' => 1,
                'content_id' => 2,
                'learning_date' => '2021-11-22',
                'learning_time' => 3
            ],
            [
                'user_id' => 1,
                'content_id' => 3,
                'learning_date' => '2021-11-23',
                'learning_time' => 4
            ]
        ];

        DB::table('content_learning_records')->insert($params);
    }
}

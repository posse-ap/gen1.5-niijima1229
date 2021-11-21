<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('learning_contents')->truncate();
        
        $param =[
            [
                'name' => 'N予備校',
                'color' => '#2A54EF'
            ],
            [
                'name' => 'ドットインストール',
                'color' => '#1B71BD'
            ],
            [
                'name' => '課題',
                'color' => '#21BDDE'
            ]
        ];
        DB::table('learning_contents')->insert($param);
    }
}

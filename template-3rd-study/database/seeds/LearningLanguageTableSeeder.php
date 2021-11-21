<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearningLanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('learning_languages')->truncate();

        $params = [
            [
                'name' => 'JavaScript',
                'color' => '#2A54EF'
            ],
            [
                'name' => 'CSS',
                'color' => '#1B71BD'
            ],
            [
                'name' => 'PHP',
                'color' => '#21BDDE'
            ],
            [
                'name' => 'HTML',
                'color' => '#3DCEFD'
            ],
            [
                'name' => 'Laravel',
                'color' => '#B39EF3'
            ],
            [
                'name' => 'SQL',
                'color' => '#6D47EC'
            ],
            [
                'name' => 'SHELL',
                'color' => '#4A18EF'
            ],
            [
                'name' => '情報システム基礎知識(その他)',
                'color' => '#3107BF'
            ]
        ];
        DB::table('learning_languages')->insert($params);
    }
}

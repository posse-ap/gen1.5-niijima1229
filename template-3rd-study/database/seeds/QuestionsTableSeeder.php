<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        $param = [
            'name' => 'ガチで東京の人しか解けない！＃東京の難読地名クイズ'
        ];

        DB::table('questions')->insert($param);

        $param = [
            'name' => 'ガチで広島の人しか解けない！＃広島の難読地名クイズ'
        ];

        DB::table('questions')->insert($param);
    }
}

<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('titles')->truncate();
        $param = [
            'title_name' => 'ガチで東京の人しか解けない！＃東京の難読地名クイズ',
            'title_number' => 1,
        ];

        DB::table('titles')->insert($param);

        $param = [
            'title_name' => 'ガチで広島の人しか解けない！＃広島の難読地名クイズ',
            'title_number' => 2,
        ];

        DB::table('titles')->insert($param);
    }
}

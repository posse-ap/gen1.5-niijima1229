<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ChoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('choices')->truncate();
        $param = [
            'question_id' => 1,
            'question_number' => 1,
            'name' => 'たかなわ',
            'valid' => true
        ];

        DB::table('choices')->insert($param);
        
        $param = [
            'question_id' => 1,
            'question_number' => 1,
            'name' => 'たかわ',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 1,
            'question_number' => 1,
            'name' => 'こうわ',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 1,
            'question_number' => 2,
            'name' => 'かめいど',
            'valid' => true
        ];

        DB::table('choices')->insert($param);
        $param = [
            'question_id' => 1,
            'question_number' => 2,
            'name' => 'かめど',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 1,
            'question_number' => 2,
            'name' => 'かめと',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 2,
            'question_number' => 1,
            'name' => 'むかいなだ',
            'valid' => true
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 2,
            'question_number' => 1,
            'name' => 'むきひら',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 2,
            'question_number' => 1,
            'name' => 'むこうひら',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 2,
            'question_number' => 2,
            'name' => 'みつぎ',
            'valid' => true,
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 2,
            'question_number' => 2,
            'name' => 'みよし',
            'valid' => false,
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 2,
            'question_number' => 2,
            'name' => 'おしらべ',
            'valid' => false,
        ];

        DB::table('choices')->insert($param);

    }
}

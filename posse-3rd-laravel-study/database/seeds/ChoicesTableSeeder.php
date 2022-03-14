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
            'choice_name' => 'たかなわ',
            'valid' => true
        ];

        DB::table('choices')->insert($param);
        
        $param = [
            'question_id' => 1,
            'choice_name' => 'たかわ',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 1,
            'choice_name' => 'こうわ',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 2,
            'choice_name' => 'かめいど',
            'valid' => true
        ];

        DB::table('choices')->insert($param);
        $param = [
            'question_id' => 2,
            'choice_name' => 'かめど',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 2,
            'choice_name' => 'かめと',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 3,
            'choice_name' => 'こうじまち',
            'valid' => true
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 3,
            'choice_name' => 'おかとまち',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 3,
            'choice_name' => 'かゆまち',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 4,
            'choice_name' => 'むかいなだ',
            'valid' => true
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 4,
            'choice_name' => 'むきひら',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 4,
            'choice_name' => 'むこうひら',
            'valid' => false
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 5,
            'choice_name' => 'みつぎ',
            'valid' => true,
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 5,
            'choice_name' => 'みよし',
            'valid' => false,
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 5,
            'choice_name' => 'おしらべ',
            'valid' => false,
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 6,
            'choice_name' => 'かなやま',
            'valid' => true,
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 6,
            'choice_name' => 'ぎんざん',
            'valid' => false,
        ];

        DB::table('choices')->insert($param);

        $param = [
            'question_id' => 6,
            'choice_name' => 'きやま',
            'valid' => false,
        ];

        DB::table('choices')->insert($param);
    }
}

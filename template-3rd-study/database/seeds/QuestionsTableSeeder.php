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
            'title_id' => 1,
            'question_number' => 1,
            'question_sentence' => 'この地名はなんて読む？',
            'img' => '1/0.png',
            'commentary' => '正解はたかなわです。'
        ];

        DB::table('questions')->insert($param);

        $param = [
            'title_id' => 1,
            'question_number' => 2,
            'question_sentence' => 'この地名はなんて読む？',
            'img' => '1/1.png',
            'commentary' => '正解はかめいどです。'
        ];

        DB::table('questions')->insert($param);

        $param = [
            'title_id' => 1,
            'question_number' => 3,
            'question_sentence' => 'この地名はなんて読む？',
            'img' => '1/2.png',
            'commentary' => '正解はこうじまちです。'
        ];

        DB::table('questions')->insert($param);

        $param = [
            'title_id' => 2,
            'question_number' => 1,
            'question_sentence' => 'この地名はなんて読む？',
            'img' => '2/0.png',
            'commentary' => '正解はむかいなだです。'
        ];

        DB::table('questions')->insert($param);

        $param = [
            'title_id' => 2,
            'question_number' => 2,
            'question_sentence' => 'この地名はなんて読む？',
            'img' => '2/1.png',
            'commentary' => '正解はみつぎです。'
        ];

        DB::table('questions')->insert($param);

        $param = [
            'title_id' => 2,
            'question_number' => 3,
            'question_sentence' => 'この地名はなんて読む？',
            'img' => '2/2.png',
            'commentary' => '正解はかなやまです。'
        ];

        DB::table('questions')->insert($param);
    }
}

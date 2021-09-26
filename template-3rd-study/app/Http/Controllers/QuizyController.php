<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class Quizycontroller extends Controller
{
    public function index(Request $request, $id=1)
    {
        $questions = DB::table('questions')
        ->join('choices', 'questions.id', '=', 'choices.question_id')
        ->where('question_id', '=', $id)
        ->get();
        $choices = DB::table('choices')->get();
        return view('quiz.index', ['questions' => $questions,'choices' => $choices, 'id' => $id]);
    }
}

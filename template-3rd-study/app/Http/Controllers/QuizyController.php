<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Question;

class Quizycontroller extends Controller
{
    public function index(Request $request)
    {
        $questions = Question::all();
        return view('quiz_all.index', ['questions' => $questions]);
    }

    public function get(Request $request, $id)
    {
        $questions = Question::idEqual('id', $id);
        $questions = Question::all();
        $title = DB::table('questions')
        ->where('id', '=', $id)
        ->first();
        return view('quiz.index', ['questions' => $questions, 'id' => $id, 'title' => $title]);
    }
}

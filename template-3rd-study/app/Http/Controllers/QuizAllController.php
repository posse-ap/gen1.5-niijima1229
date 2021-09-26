<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class QuizAllController extends Controller
{
    public function index(Request $request)
    {
        $questions = DB::table('questions')->get();
        return view('quiz_all.index', ['questions' => $questions]);
    }
}

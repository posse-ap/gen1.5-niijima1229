<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Title;
use App\Question;

class Quizycontroller extends Controller
{
    public function index(Request $request)
    {
        $titles = Title::all();
        return view('quiz_all.index', ['titles' => $titles]);
    }

    public function get(Request $request, $id)
    {
        $items = Title::idEqual($id)->first();
        return view('quiz.index', ['items' => $items]);
    }
}

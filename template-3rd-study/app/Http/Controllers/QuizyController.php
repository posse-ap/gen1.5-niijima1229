<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Quizycontroller extends Controller
{
    public function index()
    {
        return view('quizy.index');
    }
}

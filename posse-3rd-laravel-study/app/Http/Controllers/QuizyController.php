<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Title;
use App\Question;
use App\Choice;

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

    public function getAuth(Request $request)
    {
        $param = ['message' => 'ログインしてください。'];
        return view('admin.login', $param);
    }

    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $msg = 'ログインしました。(' . Auth::user()->name . ')';
        } else {
            $msg = 'ログインに失敗しました。';
        }
        return view('admin.login', ['message' => $msg]);
    }

    public function titleIndex(Request $request)
    {
        $titles = Title::orderBy('title_number', 'asc')->get();
        return view('admin.titles', ['titles' => $titles]);
    }

    public function titleAdd(Request $request)
    {
        return view('admin.titleAdd');
    }

    public function titleCreate(Request $request)
    {
        $this->validate($request, Title::$rules);
        $title = new Title;
        $form = $request->all();
        unset($form['_token']);
        $title->timestamps = false;
        $title->fill($form)->save();
        return redirect('/admin/title');
    }

    public function titleEdit(Request $request)
    {
        $title = Title::find($request->id);
        return view('admin.titleEdit', ['form' => $title]);
    }

    public function titleUpdate(Request $request)
    {
        $this->validate($request, Title::$rules);
        $title = Title::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $title->timestamps = false;
        $title->fill($form)->save();
        return redirect('/admin/title');
    }

    public function titleDel(Request $request)
    {
        $title = Title::find($request->id);
        return view('admin.titleDel', ['form' => $title]);
    }

    public function titleRemove(Request $request)
    {
        $title = Title::find($request->id)->delete();
        return redirect('/admin/title');
    }

    public function questionEdit(Request $request)
    {
        $items = Question::find($request->id);
        return view('admin.questionEdit', ['question' => $items]);
    }

    public function questionUpdate(Request $request)
    {
        $this->validate($request, Question::$rules);
        $question = Question::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $question->timestamps = false;
        $question->fill($form)->save();
        return redirect('admin/title');
    }

    public function questionAdd(Request $request)
    {
        return view('admin.questionAdd',['title_id'=> $request->title_id]);
    }

    public function questionCreate(Request $request)
    {
        $this->validate($request, Question::$rules);
        $question = new Question;
        $form = $request->all();
        unset($form['_token']);
        $question->timestamps = false;
        $question->fill($form)->save();
        return redirect('/admin/title');
    }

    public function choiceEdit(Request $request)
    {
        $items = Choice::find($request->id);
        return view('admin.choiceEdit', ['choice' => $items]);
    }

    public function choiceUpdate(Request $request)
    {
        $this->validate($request, Choice::$rules);
        $choice = Choice::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $choice->timestamps = false;
        $choice->fill($form)->save();
        return redirect('/admin/title');
    }

    public function choiceAdd(Request $request)
    {
        return view('admin.choiceAdd', ['question_id' => $request->question_id]);
    }

    public function choiceCreate(Request $request)
    {
        $this->validate($request, Choice::$rules);
        $choice = new Choice;
        $form = $request->all();
        unset($form['_token']);
        $choice->timestamps = false;
        $choice->fill($form)->save();
        return redirect('/admin/title');
    }

    public function choiceRemove(Request $request)
    {
        $title = Choice::find($request->id)->delete();
        return redirect('/admin/title');
    }
}

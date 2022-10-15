<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\LearningLanguage;
use App\Model\LearningContent;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function language()
    {
        $languages = LearningLanguage::where('status', 1)->get();
        return view('language', compact('languages'));
    }

    public function language_create(Request $request)
    {
        $language = new LearningLanguage;
        $language->name = $request->name;
        $language->color = $request->color;
        $language->save();
        return redirect(route('language'));
    }

    public function language_update(Request $request, $id)
    {
        $language = LearningLanguage::find($id);
        $language->name = $request->name;
        $language->color = $request->color;
        $language->save();
        return redirect(route('language'));
    }

    public function language_destroy(Request $request, $id)
    {
        $language = LearningLanguage::find($id);
        $language->status = 2;
        $language->save();
        return redirect(route('language'));
    }

    public function content()
    {
        $contents = LearningContent::where('status', 1)->get();
        return view('content', compact('contents'));
    }

    public function content_create(Request $request)
    {
        $content = new LearningContent;
        $content->name = $request->name;
        $content->color = $request->color;
        $content->save();
        return redirect(route('content'));
    }

    public function content_update(Request $request, $id)
    {
        $content = LearningContent::find($id);
        $content->name = $request->name;
        $content->color = $request->color;
        $content->save();
        return redirect(route('content'));
    }

    public function content_destroy(Request $request, $id)
    {
        $content = LearningContent::find($id);
        $content->status = 2;
        $content->save();
        return redirect(route('content'));
    }

    public function user()
    {
        $users = User::get();
        return view('user_all', compact('users'));
    }

    public function user_create(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        return redirect(route('user'));
    }
}

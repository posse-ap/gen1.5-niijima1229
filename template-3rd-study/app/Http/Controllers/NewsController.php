<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $news = $client->request('GET', 'https://bkrs3waxwg.execute-api.ap-northeast-1.amazonaws.com/default/news');
        // $news = Http::get("https://bkrs3waxwg.execute-api.ap-northeast-1.amazonaws.com/default/news");
        $news = json_decode($news->getBody(), true);
        // dd($news);
        return view('news', compact('news'));
    }

    public function detail($id)
    {
        $client = new \GuzzleHttp\Client();
        $news = $client->request('GET', 'https://bkrs3waxwg.execute-api.ap-northeast-1.amazonaws.com/default/news/' . $id);
        // $news = Http::get("https://bkrs3waxwg.execute-api.ap-northeast-1.amazonaws.com/default/news");
        $news = json_decode($news->getBody(), true);
        // dd($news);
        return view('news_detail', compact('news'));
    }
}

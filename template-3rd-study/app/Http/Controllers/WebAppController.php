<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\ContentLearningRecord;
use App\Model\LanguageLearningRecord;
use App\Model\LearningContent;
use App\Model\LearningLanguage;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use App\User;

class WebAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::find($user_id);
        $today = Carbon::today();
        $today_learning_language_time = LanguageLearningRecord::where('user_id', $user_id)->where('learning_date', $today)->sum('learning_time');
        $today_learning_content_time = ContentLearningRecord::where('user_id', $user_id)->where('learning_date', $today)->sum('learning_time');
        $month_learning_language_time = LanguageLearningRecord::where('user_id', $user_id)->whereMonth('learning_date', $today->month)->sum('learning_time');
        $month_learning_content_time = ContentLearningRecord::where('user_id', $user_id)->whereMonth('learning_date', $today->month)->sum('learning_time');
        $total_learning_language_time = LanguageLearningRecord::where('user_id', $user_id)->sum('learning_time');
        $total_learning_content_time = ContentLearningRecord::where('user_id', $user_id)->sum('learning_time');

        $language_learning_records = LanguageLearningRecord::where('user_id', $user_id)->get();
        $content_learning_records = ContentLearningRecord::where('user_id', $user_id)->get();
        $learning_languages = LearningLanguage::all();
        $learning_contents = LearningContent::all();
        $aggregate_learning_languages = LanguageLearningRecord::select(DB::raw("sum(learning_time) as total_language_learning_time,learning_language_id"))->groupBy("learning_language_id")->get();
        $aggregate_learning_contents = ContentLearningRecord::select(DB::raw("sum(learning_time) as total_content_learning_time,learning_content_id"))->groupBy("learning_content_id")->get();

        $per_day_learning_language_times = LanguageLearningRecord::select(DB::raw("sum(learning_time) as total_language_learning_time,learning_date"))
            ->whereBetween('learning_date', [$today->startOfMonth()->format('Y-m-d'), $today->endOfMonth()->format('Y-m-d')])
            ->groupBy("learning_date")->get();
        $per_day_learning_content_times = ContentLearningRecord::select(DB::raw("sum(learning_time) as total_content_learning_time,learning_date"))
            ->whereBetween('learning_date', [$today->startOfMonth()->format('Y-m-d'), $today->endOfMonth()->format('Y-m-d')])
            ->groupBy("learning_date")->get();
        $sums = array();
        foreach (CarbonPeriod::create($today->startOfMonth()->format('Y-m-d'), $today->endOfMonth()->format('Y-m-d'))->toArray() as $date) {
            $per_day_learning_language_time = $per_day_learning_language_times->filter(function ($value, $key) use ($date) {
                return ($value->learning_date == $date->format('Y-m-d'));
            });

            $per_day_learning_content_time = $per_day_learning_content_times->filter(function ($value, $key) use ($date) {
                return ($value->learning_date == $date->format('Y-m-d'));
            });

            $sums[$date->format('Y-m-d')] = ($per_day_learning_language_time->isEmpty() ? 0 : $per_day_learning_language_time->first()->total_language_learning_time) + ($per_day_learning_content_time->isEmpty() ? 0 : $per_day_learning_content_time->first()->total_content_learning_time);
        }
        return view('index', [
            'user' => $user,
            'today_learning_time' => $today_learning_language_time + $today_learning_content_time,
            'month_learning_time' => $month_learning_language_time + $month_learning_content_time,
            'total_learning_time' => $total_learning_language_time + $total_learning_content_time,
            'language_learning_records' => $language_learning_records,
            'content_learning_records' => $content_learning_records,
            'learning_languages' => $learning_languages,
            'learning_contents' => $learning_contents,
            'aggregate_learning_languages' => $aggregate_learning_languages,
            'aggregate_learning_contents' => $aggregate_learning_contents,
            'per_day_learning_times' => $sums
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total = count($request->learning_content_ids) + count($request->learning_language_ids);
        $study_time = $request->study_time / $total;
        if (count($request->learning_content_ids) > 0) {
            foreach ($request->learning_content_ids as $id) {
                $content = new ContentLearningRecord();
                $content->user_id = Auth::id();
                $content->learning_content_id = $id;
                $content->learning_time = $study_time;
                $content->learning_date = $request->study_date;
                $content->save();
            }
        }
        if (count($request->learning_language_ids) > 0) {
            foreach ($request->learning_language_ids as $id) {
                $language = new LanguageLearningRecord();
                $language->user_id = Auth::id();
                $language->learning_language_id = $id;
                $language->learning_time = $study_time;
                $language->learning_date = $request->study_date;
                $language->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

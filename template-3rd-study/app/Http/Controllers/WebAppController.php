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
use Illuminate\Support\Facades\Hash;

class WebAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
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
        $learning_languages = LearningLanguage::get();
        for ($i = 0; $i < count($learning_languages); $i++) {
            for ($j = $i + 1; $j < count($learning_languages); $j++) {
                if ($learning_languages[$j]->StudyTime() > $learning_languages[$i]->StudyTime()) {
                    $tmp = $learning_languages[$j];
                    $learning_languages[$j] = $learning_languages[$i];
                    $learning_languages[$i] = $tmp;
                }
            }
        }
        $learning_contents = LearningContent::get();
        for ($i = 0; $i < count($learning_contents); $i++) {
            for ($j = $i + 1; $j < count($learning_contents); $j++) {
                if ($learning_contents[$j]->StudyTime() > $learning_contents[$i]->StudyTime()) {
                    $tmp = $learning_contents[$j];
                    $learning_contents[$j] = $learning_contents[$i];
                    $learning_contents[$i] = $tmp;
                }
            }
        }
        $modal_learning_languages = LearningLanguage::where('status', 1)->get();
        $modal_learning_contents = LearningContent::where('status', 1)->get();
        $aggregate_learning_languages = LanguageLearningRecord::where('user_id', $user_id)->select(DB::raw("sum(learning_time) as total_language_learning_time,learning_language_id"))->groupBy("learning_language_id")->orderby('total_language_learning_time', 'desc')->get();
        $aggregate_learning_contents = ContentLearningRecord::where('user_id', $user_id)->select(DB::raw("sum(learning_time) as total_content_learning_time,learning_content_id"))->groupBy("learning_content_id")->orderby('total_content_learning_time', 'desc')->get();

        $per_day_learning_language_times = LanguageLearningRecord::where('user_id', $user_id)->select(DB::raw("sum(learning_time) as total_language_learning_time,learning_date"))
            ->whereBetween('learning_date', [$today->startOfMonth()->format('Y-m-d'), $today->endOfMonth()->format('Y-m-d')])
            ->groupBy("learning_date")->get();
        $per_day_learning_content_times = ContentLearningRecord::where('user_id', $user_id)->select(DB::raw("sum(learning_time) as total_content_learning_time,learning_date"))
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
            'modal_learning_languages' => $modal_learning_languages,
            'modal_learning_contents' => $modal_learning_contents,
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
        if ($request->learning_content_ids && $request->learning_language_ids) {
            $total = count($request->learning_content_ids) + count($request->learning_language_ids);
        } else if ($request->learning_content_ids) {
            $total = count($request->learning_content_ids);
        } else if ($request->learning_language_ids) {
            $total = count($request->learning_language_ids);
        }
        $study_time = $request->study_time / $total;
        if ($request->learning_content_ids && count($request->learning_content_ids) > 0) {
            foreach ($request->learning_content_ids as $id) {
                $content = new ContentLearningRecord();
                $content->user_id = Auth::id();
                $content->learning_content_id = $id;
                $content->learning_time = $study_time;
                $content->learning_date = $request->study_date;
                $content->save();
            }
        }
        if ($request->learning_language_ids && count($request->learning_language_ids) > 0) {
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
    public function user_edit()
    {
        $user = User::find(Auth::id());
        return view('user_update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_update(Request $request)
    {
        $user = User::find(Auth::id());
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        return redirect(route('webapp', ['user_id' => Auth::id()]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_destroy($id)
    {
        User::find($id)->delete();
        return redirect(route('home'));
    }
}

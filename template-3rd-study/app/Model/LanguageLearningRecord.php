<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LanguageLearningRecord extends Model
{
    public function learning_language()
    {
        return $this->belongsTo('App\Model\LearningLanguage');
    }

    // public function learning_content_time($date)
    // {
    //     return $this->where('learning_date', $date)->sum('learning_time')->get();
    // }

    public function aggregate_learning_language_time()
    {
        return ;
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LearningLanguage extends Model
{
    public function StudyTime()
    {
        if (LanguageLearningRecord::where('user_id', Auth::id())->where('learning_language_id', $this->id)->exists()) {
            return LanguageLearningRecord::where('user_id', Auth::id())->where('learning_language_id', $this->id)->sum('learning_time');
        }
        return 0;
    }
}

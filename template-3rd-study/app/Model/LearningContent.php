<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LearningContent extends Model
{
    public function StudyTime()
    {
        if (ContentLearningRecord::where('user_id', Auth::id())->where('learning_content_id', $this->id)->exists()) {
            return ContentLearningRecord::where('user_id', Auth::id())->where('learning_content_id', $this->id)->sum('learning_time');
        }
        return 0;
    }
}

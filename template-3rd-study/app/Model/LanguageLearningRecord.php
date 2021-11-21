<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LanguageLearningRecord extends Model
{
    public function learning_language()
    {
        return $this->belongsTo('App\Model\LearningLanguage');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContentLearningRecord extends Model
{
    public function learning_content()
    {
        return $this->belongsTo('App\Model\LearningContent');
    }
}

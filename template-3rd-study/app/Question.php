<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = array('id');

    public function scopeIdEqual($query, $str)
    {
        return $query->where('question_number', $str);
    }

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }


}

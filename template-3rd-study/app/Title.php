<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title_name' => 'required'
    );

    public function scopeIdEqual($query, $str)
    {
        return $query->where('id', $str)->orderBy('title_number', 'asc');
    }

    public function questions()
    {
        return $this->hasMany('App\Question')->orderBy('question_number', 'asc');
    }

}

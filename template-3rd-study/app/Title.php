<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $guarded = array('id');

    public function scopeIdEqual($query, $str)
    {
        return $query->where('id', $str);
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $primaryKey = 'question_number';
    protected $guarded = array('id');

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }

    public function scopeIdEqual($query, $str)
    {
        return $query->where('id', $str);
    }

    public function getName()
    {
        return $this->name;
    }
}

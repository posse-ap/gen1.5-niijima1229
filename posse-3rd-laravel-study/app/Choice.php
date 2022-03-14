<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'valid' => 'required'
    );
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeRecord extends Model
{
    //

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

}

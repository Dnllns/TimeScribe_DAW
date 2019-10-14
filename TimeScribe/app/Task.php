<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    // -------------------------------RELATIONS--------------------------------------

    // N:1 TASKGROUP
    public function taskGroup()
    {
        return $this->belongsTo('App\TaskGroup');
    }

    // 1:N TIMERECORDS
    public function TimeRecords()
    {
        return $this->hasMany('App\TimeRecord');
    }

    // N:N USARIOS
    public function users()
    {
        return $this->belongsToMany('App\user');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    public $timestamps = false;


    protected $fillable = [
        // 'user_id',
        'task_group_id',
        'name',
        'description',
        'status',
        'start_date',
        'finish_date',
    ];


    
    //TASK STATUS
    const STATUS_TODO = 0;
    const STATUS_DOING = 1;
    const STATUS_DONE = 2;


    public function getAssignedDevelopers(){
        return $this->users;
    }




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

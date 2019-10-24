<?php

namespace App;

use App\Http\Controllers\TaskController;
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
        'visible',
    ];

    //TASK STATUS
    const STATUS_TODO = 0;
    const STATUS_DOING = 1;
    const STATUS_DONE = 2;

    const VISIBLE = 1;
    const INVISIBLE = 2;

    public function getAssignedDevelopers()
    {
        return $this->users;
    }

    public function getWorkedTime()
    {

        return TaskController::getWorkedTime($this->id);

    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function getStatusIcon()
    {

        switch ($this->status) {
            case $this::STATUS_TODO:
                echo '<i class="far fa-clipboard ml-3" data-toggle="tooltip" data-placement="right" title="To do"></i>';
                break;

            case $this::STATUS_DOING:
                echo '<i class="fas fa-pencil-alt ml-3" data-toggle="tooltip" data-placement="right" title="Doing"></i>';
                break;

            case $this::STATUS_DONE:
                echo '<i class="fas fa-clipboard-check ml-3" data-toggle="tooltip" data-placement="right" title="Done"></i>';
                break;

        }

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

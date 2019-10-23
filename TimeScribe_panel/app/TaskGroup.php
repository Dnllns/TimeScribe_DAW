<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;


class TaskGroup extends Model
{

    //TASK STATUS
    const STATUS_TODO = 0;
    const STATUS_DOING = 1;
    const STATUS_DONE = 2;
    
    const VISIBLE = 1;
    const INVISIBLE = 2;
    



    protected $table = 'taskgroups';

    protected $fillable = [
        'project_id', 'name', 'description', 'status', 'start_date', 'finish_date',
    ];
    



    // -------------------------------FUNCTIONS-------------------------------------

    public function getTasks($status)
    {

        $tasks = $this->tasks;
        $searchedTasks = array();

        foreach ($tasks as $task) {
            if ($task->status == $status && $task->visible == $task->VISIBLE) {
                array_push( $searchedTasks, $task);
            }
        }
        
        return $searchedTasks;
    }


    public function getPercentCompleted(){


        $toDo = count($this->getTasks(Task::STATUS_TODO));
        $doing = count($this->getTasks(Task::STATUS_DOING));
        $done = count($this->getTasks(Task::STATUS_DONE));

        return (($toDo + $doing) * 100) / ($toDo + $doing + $done);

    }




    // -------------------------------RELATIONS--------------------------------------

    //N:1 PROJECT
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    //1:N TASK
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}

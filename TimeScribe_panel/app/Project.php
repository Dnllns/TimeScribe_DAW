<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //PROJECT STATUSS
    const STATUS_TODO = 0;
    const STATUS_DOING = 1;
    const STATUS_DONE = 2;

    //PROJECT PERMISSIONS
    const PERM_ALL = 0;
    const PERM_EDIT = 1;
    const PERM_VIEW = 2;

    //DB TABLE
    protected $table = 'projects';

    protected $fillable = [
        // 'user_id',
        'client_id',
        'name',
        'description',
        'status',
        'start_date',
        'finish_date',
    ];

    //FUNCIONES

    // -------------------------------RELATIONS--------------------------------------

    //N:N USERS
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    //1:N TASKGROUP
    public function taskGroups()
    {
        return $this->hasMany('App\TaskGroup');
    }

    //1:1 BILLS
    public function bill()
    {
        return $this->hasOne('App\Bill');
    }



    // --------------------



    public function getPercentCompleted()
    {


        $taskGroups = $this->taskGroups;
        $percent = 0;
        $result = 0;
        $count = 0;


        foreach ($taskGroups as $taskgroup ) {

            if( count($taskgroup->tasks) != 0){
                $percent += $taskgroup->getPercentCompleted();
                $count+=1;
            }
        }

        try {
            $result =  $percent / $count;
        } catch (\Exception $e) {
        }

        return $result;

    }
}

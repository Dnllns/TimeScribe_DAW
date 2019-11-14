<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
    //PROJECT STATUSS
    const STATUS_TODO = 0;
    const STATUS_DOING = 1;
    const STATUS_DONE = 2;

    //PROJECT PERMISSIONS
    const PERM_ALL = 0;
    const PERM_WORK = 1;
    const PERM_VIEW = 2;

    //VISIBILITY
    const INVISIBLE = 0;
    const VISIBLE = 1;

    //DB TABLE
    protected $table = 'projects';

    protected $fillable = [
        'client_id',
        'name',
        'description',
        'status',
        'visible',
        'created_by_id',
        'start_date',
        'finish_date',
    ];

    //FUNCIONES

    // -------------------------------RELATIONS--------------------------------------

    //N:N USERS
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_projects', 'user_id', 'project_id');

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



    /**
     * GET PORCENTAJE
     * ----------------
     * Obtiene el porcentaje de completado para este proyecto basandose
     * en el porcentaje de completado que tienen sus grupos de tarea.
     * @return Integer, el porcentaje calculado
     */
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
            //posible division por 0
        }

        return $result;
    }


    /**
     * GET USER CREADOR
     * -------------------
     * Obtiene el usuario que ha creado el proyecto
     * @return User, el usuario que ha creado el proyecto
     */
    public function getCreator(){
        return User::find($this->created_by_id);
    }

    /**
     * GET DESARROLLADORES
     * ----------------------
     * Obtiene los desarrolladores que pueden participar en el proyecto
     * @return Collection[User], una coleccion con los usuarios 
     */
    public function getDevelopers(){
        return $this->users()->where('permissions', Project::PERM_WORK )->get();
    }






}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Task;

class TaskGroup extends Model
{

    //STATUS
    const STATUS_TODO = 0;
    const STATUS_DOING = 1;
    const STATUS_DONE = 2;

    //VISIBILITY
    const INVISIBLE = 0;
    const VISIBLE = 1;

    protected $table = 'taskgroups';
    protected $fillable = ['project_id', 'name', 'description', 'status', 'start_date', 'finish_date'];

    
    /**
     * -------------------------------------------------------------
     * --------------------------FUNCTIONS--------------------------
     * -------------------------------------------------------------
     */

    #region FUNCTIONS


    /**
     * OBTENER TAREAS
     * -------------------
     * Obtiene las tareas pertenecientes al Grupo de tarea que tengan el estado == a $status
     * @param Integer $status, uno de los estados posibles de TaskGroup::STATUS_*
     * @return array[Task], un array con las tareas coincidentes
     * 
     */
    public function getTasks($status)
    {

        $tasks = $this->tasks;
        $searchedTasks = array();

        foreach ($tasks as $task) {

            if ($task->status == $status) { // && $task->getVisible() == $task::VISIBLE
                array_push($searchedTasks, $task);
            }
        }

        return $searchedTasks;
    }


    /**
     * OBTENER EL PORCENTAJE DE COMPLETO DEL GRUPO
     * -------------------------------------------
     * Obtine el porcentaje de completado del grupo de tareas,
     * basandose en los estados de las tareas pertenecientes a ese grupo
     * @return Integer, el porcentaje
     */
    public function getPercentCompleted()
    {
        $toDo = count($this->getTasks(Task::STATUS_TODO));
        $doing = count($this->getTasks(Task::STATUS_DOING));
        $done = count($this->getTasks(Task::STATUS_DONE));
        $result = 0;

        try {
            $result = 100 - round((($toDo + $doing) * 100) / ($toDo + $doing + $done));
        } catch (\Exception $e) {
        }

        return $result;

    }

    #endregion

    
    /**
     * ---------------------------------------------------------------
     * --------------------------RELATIONS----------------------------
     * ---------------------------------------------------------------
     */

    #region RELATIONS BD

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

    #endregion
}

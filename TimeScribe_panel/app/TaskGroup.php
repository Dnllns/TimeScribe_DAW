<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{

    /**
     * --------------------------Class------------------------------
     * -------------------------------------------------------------
     */

    #region Class

    //STATUS
    const STATUS_TODO = 0;
    const STATUS_DOING = 1;
    const STATUS_DONE = 2;

    //VISIBILITY
    const INVISIBLE = 0;
    const VISIBLE = 1;

    protected $table = 'taskgroups';
    protected $fillable = ['project_id', 'name', 'description', 'status', 'visible', 'start_date', 'finish_date'];
    public $timestamps = false;

    #endregion

    /**
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

    /**
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

    public function getDevelopers()
    {

        $developers_array = array();

        // Obtener las tareas del grupo
        $tasks = $this->tasks();

        foreach ($tasks as $task) {
            // Obtener los desarrolladores de cada tarea

            $devs = $task->getDevelopers();

            foreach ($devs as $dev) {
                // Añadir el desarrollador al array si no se ha añadido ya

                if (!in_array($dev, $developers_array)) {
                    array_push($developers_array, $dev);
                }
            }
        }

        return $developers_array;

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

    /*
     * GET ICONO DE ESTADO
     * ---------------------
     * Obtiene el icono de el estado en el que se encuentra el grupo de tareas paa mostrarlo en la vista
     */
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

    /*
     * GET ICONO DE ESTADO
     * ---------------------
     * Obtiene el icono de la visibilidad del grupo de tareas
     */
    public function getVisibilityIcon()
    {

        if ($this->visible == 1) {
            echo '<i class="far fa-eye" data-toggle="tooltip" data-placement="right" title="Visible"></i>';
        } else {
            echo '<i class="fas fa-eye-slash" data-toggle="tooltip" data-placement="right" title="Not visible"></i>';
        }

    }

    #endregion

}

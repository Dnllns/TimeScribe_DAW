<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * --------------------Class----------------------------
     * -----------------------------------------------------
     */

    #region Class

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

    //VISIBLE
    const VISIBLE = 1;
    const INVISIBLE = 0;

    #endregion

    /**
     * ------------------FUNCTIONS--------------------------
     * -----------------------------------------------------
     */

    #region FUNCIONES

    /**
     * Obtiene el tiempo trabajado en la tarea
     * @param Integer $taskId, el id de la tarea
     * @return DateTime, el tiempo trabajado
     */
    public static function getWorkedTime($taskId)
    {
        // $taskId = $this->id;
        $timeRecords = TimeRecord::where('task_id', $taskId)->where('user_id', auth()->user()->id)->get();

        $totalTime = new \DateTime('2000-01-01');

        foreach ($timeRecords as $timeRecord) {

            $start = new \DateTime($timeRecord->start_date);
            $finish = new \DateTime($timeRecord->finish_date);

            // Obtener el tiempo que se ha trabajado en cada timerecord
            $interval = $start->diff($finish);

            //Sumar el tiempo
            $totalTime->add($interval);

        }

        return $totalTime->format('H:i:s');
    }

    public function getDevelopers()
    {
        return $this->users()->get();
    }


    /**
     * GET ICONO DE ESTADO
     * ---------------------
     * Obtiene el icono de el estado en el que se encuentra la tarea paa mostrarlo en la vista
     */
    public function getStatusIcon()
    {

        switch ($this->status) {
            case $this::STATUS_TODO:
                echo '<i class="far fa-clipboard" data-toggle="tooltip" title="To do"></i>';
                break;

            case $this::STATUS_DOING:
                echo '<i class="fas fa-pencil-alt" data-toggle="tooltip" title="Doing"></i>';
                break;

            case $this::STATUS_DONE:
                echo '<i class="fas fa-clipboard-check" data-toggle="tooltip" title="Done"></i>';
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

    /**
     * ------------------RELATIONS--------------------------
     * -----------------------------------------------------
     */

    #region RELATIONS

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
        return $this->belongsToMany('App\user', 'tasks_users', 'task_id', 'user_id');
    }

    #endregion



}

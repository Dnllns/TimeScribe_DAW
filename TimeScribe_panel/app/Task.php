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
        const INVISIBLE = 2;

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



    // public function setDeveloper($idDeveloper){

    //     $this->user_id = $idDeveloper;
    //     $this->save();

    // }

    public function getDevelopers()
    {
        return $this->users()->get();
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
            return $this->belongsToMany('App\user',  'tasks_users', 'task_id', 'user_id');
        }

    #endregion

}

<?php

namespace App\Http\Controllers;

use App\TimeRecord;

class TimeRecordController extends Controller
{


    /**
     * ELIMINAR TIMERECORDS BORRADOR
     * -----------------------------
     * Elimina los timerecords de la tarea con id pasado por parametro del usuario logeado
     * Solo son eliminado los marcados como borrador
     * @param Integer $task_id, el id de la tarea
     */
    public function removeLastTimerecordsInteraction($task_id)
    {

        $lastTimerecords = TimeRecord::
            where('user_id', auth()->user()->id)->
            where('task_id', $task_id)->
            where('status', Timerecord::STATUS_DRAFT);

        $lastTimerecords->forceDelete();
    }

    /**
     * ACTUALIZAR TIMERECORDS A FINALIZADO
     * -----------------------------------
     * Actualiza los timerecords de la tarea con id pasado por parametro del usuario logeado
     * Cambia el valor de el campo status a STATUS_FINAL
     * @param Integer $task_id, el id de la tarea
     */
    public function setFinalTimerecordsInteraction($task_id)
    {
        // Obtener los registros correspondientes al usuario y tarea que esten como borrador
        $lastTimerecords = TimeRecord::
            where('user_id', auth()->user()->id)->
            where('task_id', $task_id)->
            where('status', Timerecord::STATUS_DRAFT)->get();

        // Actualizar el campo status a finalizado para todas las tareas
        foreach ($lastTimerecords as $timeRecord) {
            $timeRecord->status = Timerecord::STATUS_FINAL;
            $timeRecord->save();
        }
    }
}

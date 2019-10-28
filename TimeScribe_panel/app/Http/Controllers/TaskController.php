<?php

namespace App\Http\Controllers;

use App\Task;
use App\TimeRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskGroupController;



class TaskController extends Controller
{

    /**
     * ------------------------------------------------------------------------------------
     * -------------------------------GESTION DE TAREAS------------------------------------
     * ------------------------------------------------------------------------------------
     */

    /**
     * CREAR NUEVA TAREA
     * Recibe los datos de un POST y los usa para crear una nueva tarea dentro de un grupo de tareas
     * @param Request $data, el request de la vista anterior
     * @param Integer $taskGroupId, el id del grupo de tarea
     * @return View TaskController@view_editTask, la vista de editar tarea
     */
    protected function create(Request $data, $taskGroupId)
    {
        //Insert in taskgroup table
        $insert = Task::create([
            'task_group_id' => $taskGroupId,
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return TaskController::view_editTask($insert->id);
    }

    /**
     * ACTUALIZAR TAREA
     * Recibe los datos de un POST y los usa para actualizar una tarea existente
     * @param Request $data, el request de la vista anterior
     * @param Integer $taskId, el id de la tarea
     * @return View TaskController@view_editTask, la vista de editar tarea
     */
    public function updateTask(Request $data, $taskId)
    {

        $task = Task::find($taskId);

        //Udate fields
        $task->name = $data['name'];
        $task->description = $data['description'];

        //Update database
        $task->save();

        return TaskController::view_editTask($task->task_group_id);

    }

    /**
     * ELIMINAR TAREA
     * Actualiza la tarea en Base de datos, la marca como INVISIBLE (no la elimina)
     * @param Integer $taskId, el id de la tarea
     * @return View TaskGroupController@view_editTaskGroup, la vista de editar un grupo de tareas
     */
    public function deleteTask($taskId)
    {

        // //REAL DELETE
        // $task = Task::find($taskId);
        // $taskgroupId = $task->task_group_id;
        // $task->delete();

        $task = Task::find($taskId);
        $task->visible = Task::INVISIBLE;
        $task->save();

        return TaskGroupController::view_editTaskGroup($task->task_group_id);

    }

    /**
     * ------------------------------------------------------------------------------------
     * ------------------------------------METODOS-----------------------------------------
     * ------------------------------------------------------------------------------------
     */

    /**
     * Inicia la cuenta de tiempo de una tarea,
     * Inserta en la tabla timerecords un nuevo registro para la tarea, con los ides y la fecha de inicio
     */
    public function startCount($taskId)
    {
        $insert = TimeRecord::create([
            'user_id' => auth()->user()->id,
            'task_id' => $taskId,
            'start_date' => Carbon::now()->toDateTimeString(),
        ]);

    }

    public function stopCount()
    {

        $timeRecord = TimeRecord::
            where('finish_date', null)
            ->where('user_id', auth()->user()->id)->first();

        $timeRecord->finish_date = Carbon::now()->toDateTimeString();
        $timeRecord->save();

    }

    public static function getWorkedTime($taskId)
    {

        $timeRecords = TimeRecord::
            where('task_id', $taskId)
            ->where('user_id', auth()->user()->id)->get();

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

    /**
     *
     * INICIAR TAREA (TODO)
     * -----------------------
     *
     * Actualiza la tarea con el id passado por parametro
     * Añade la fecha a el campo fecha de inicio de la tarea
     * Actualiza el estado de la traea a haciendose
     *
     * Si el proyecto y el grupo de tareas al que pertenece esa tarea todavia no ha sido iniciado se inicia
     *
     */
    public function startNewTask($taskId)
    {


        // Actualizar la tarea en BD (tabla tasks)
        // Añadir la fecha de inicio y marcar como haciendose
        $task = Task::find($taskId);
        $task->start_date = Carbon::now()->toDateTimeString();
        $task->status = Task::STATUS_DOING;
        $task->save();


        // Actualizar el grupo de tareas
        TaskGroupController::startTaskGroup($task->taskGroup()->id);

        // Actualizar el proyecto en BD (tabla project)
        // Solo si no se ha empezado ya
        ProjectController::startProject($task->taskGroup()->project_id);

        // Redireccionar a la ruta de dashboard del proyecto
        return ProjectController::view_dashboard($task->taskGroup()->project_id);

    }

    public function setDone($taskId)
    {

        $task = Task::find($taskId);
        $task->status = Task::STATUS_DONE;
        $task->finish_date = Carbon::now()->toDateTimeString();
        $task->save();

        // return ProjectController::view_selectProject();

    }

    /**
     * ------------------------------------------------------------------------------------
     * ------------------------------------VISTAS------------------------------------------
     * ------------------------------------------------------------------------------------
     */

    /**
     * VISTA CREAR TAREA
     * Devuelve la vista de crear una tarea dentro de un grupo de tareas
     * @param Integer $taskGroupId, el id del Grupo de tareas
     */
    public function view_newTask($taskGroupId)
    {
        return view('task/Ts_Create', ['taskGroupId' => $taskGroupId]);
    }

    /**
     * VISTA EDITAR TAREA
     * Devuelve la vista de editar una tarea
     * @param Integer $taskId, el id de la tarea
     */
    public function view_editTask($taskId)
    {
        return view('task/Ts_Edit', ['task' => Task::find($taskId)]);
    }

}

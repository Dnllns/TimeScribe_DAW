<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskGroupController;
use App\Task;
use App\TimeRecord;
use App\WorkGroup;
use App\TaskGroup;
use App\Project;


use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * ------------------------------------------------------------------------------------
     * -------------------------------GESTION DE TAREAS------------------------------------
     * ------------------------------------------------------------------------------------
     */

    #region GESTION

    /**
     * CREAR NUEVA TAREA
     * Recibe los datos de un POST y los usa para crear una nueva tarea dentro de un grupo de tareas
     * @param Request $data, el request de la vista anterior
     * @param Integer $taskGroupId, el id del grupo de tarea
     * @return View TaskController@view_editTask, la vista de editar tarea
     */
    protected function create(Request $data, $taskGroupId)
    {
        //Insert in task table
        $newTask = Task::create([
            'task_group_id' => $taskGroupId,
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        // Obtener la tarea
        $user = auth()->user();

        //Añadir la relacion en TASK_USER
        $newTask->users()->attach(
            $user->id,
            [
                'user_id' => $user->id,
                'task_id' => $newTask->id
            ]

        );


        return TaskGroupController::view_editTaskGroup($taskGroupId);
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
        $task->visible = $data['visible'];

        //Update database
        $task->save();

        return TaskGroupController::view_editTaskGroup($task->task_group_id);

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

    #endregion

    /**
     * ------------------------------------------------------------------------------------
     * ------------------------------------FUNCIONES---------------------------------------
     * ------------------------------------------------------------------------------------
     */

    #region FUNCIONES

        /**
     * Obtiene el tiempo trabajado en la tarea
     * @param Integer $taskId, el id de la tarea
     * @return DateTime, el tiempo trabajado
     */
    public function getWorkedTime($taskId)
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


        $response = json_encode($totalTime->format('H:i:s'));
        return $response;
    }

    /**
     * COMENZAR A CONTAR TIEMPO
     * -------------------------
     * Inicia la cuenta de tiempo de una tarea (FICTICIO),
     * Inserta en la tabla timerecords un nuevo registro para la tarea, con los ides y la fecha de inicio
     * @param Integer $taskId, el id de la tarea
     */
    public function startCount($taskId)
    {
        $insert = TimeRecord::create([
            'user_id' => auth()->user()->id,
            'task_id' => $taskId,
            'start_date' => Carbon::now()->toDateTimeString(),
        ]);
    }

    /**
     * PARAR DE CONTAR TIEMPO
     * ------------------------
     * Para la cuenta de tiempo de una tarea (FICTICIO)
     * Actualiza en la tabla timerecords el campo finish_date con la fecha actual
     * Actualiza los registros del usuario logeado, que tengan finish_date null y con status borrador
     *
     */
    public function stopCount()
    {
        $timeRecord = TimeRecord::
            where('finish_date', null)->
            where('status', TimeRecord::STATUS_DRAFT)->
            where('user_id', auth()->user()->id)->first();
        $timeRecord->finish_date = Carbon::now()->toDateTimeString();
        $timeRecord->save();
    }

    /**
     * INICIAR TAREA (TODO)
     * -----------------------
     * Actualiza la tarea con el id passado por parametro
     * Añade la fecha a el campo fecha de inicio de la tarea
     * Actualiza el estado de la traea a haciendose
     *
     * Si el proyecto y el grupo de tareas al que pertenece esa tarea todavia no ha sido iniciado se inicia
     * @param Integer $taskId, el id de la tarea a iniciar
     * @return View dashboard del proyecto
     */
    public function setStarted($taskId)
    {

        // Actualizar la tarea en BD (tabla tasks)
        // Añadir la fecha de inicio y marcar como haciendose
        $task = Task::find($taskId);
        $task->start_date = Carbon::now()->toDateTimeString();
        $task->status = Task::STATUS_DOING;
        $task->save();


        // Actualizar el grupo de tareas
        $taskGroupId = $task->taskGroup()->first()->id;
        TaskGroupController::startTaskGroup($taskGroupId);

        // Actualizar el proyecto en BD (tabla project)
        // Solo si no se ha empezado ya
        $projectId = $task->taskGroup()->first()->project_id;
        ProjectController::startProject($projectId);

        // Redireccionar a la ruta de dashboard del proyecto
        //return ProjectController::view_dashboard($projectId);
    }

    /**
     * TERMINAR TAREA
     * ------------------
     * Actualiza las estructuras de la tarea en BD,
     * le pone el estado de terminado y añade la fecha de finalizacion
     * @param Integer $taskId, el id de la tarea
     */
    public function setDone($taskId)
    {

        $task = Task::find($taskId);
        $task->status = Task::STATUS_DONE;
        $task->finish_date = Carbon::now()->toDateTimeString();
        $task->save();

    }


    public function addDeveloper( $taskId, $devId){

        $task = Task::find($taskId);

        $task->users()->attach(
            $devId,
            [
                'task_id' => $taskId,
                'user_id' => $devId,
            ]
        );
    }


    public function delDeveloper( $taskId, $devId){

        $task = Task::find($taskId);
        $task->users()->detach($devId);

    }

    #endregion

    /**
     * ------------------------------------------------------------------------------------
     * ------------------------------------VISTAS------------------------------------------
     * ------------------------------------------------------------------------------------
     */

    #region VISTAS

    /**
     * VISTA CREAR TAREA
     * Devuelve la vista de crear una tarea dentro de un grupo de tareas
     * @param Integer $taskGroupId, el id del Grupo de tareas
     * @return View
     */
    public function view_newTask($taskGroupId)
    {
        return view('task/new', ['taskGroupId' => $taskGroupId]);
    }

    /**
     * VISTA EDITAR TAREA
     * Devuelve la vista de editar una tarea
     * @param Integer $taskId, el id de la tarea
     * @return View
     */
    public function view_editTask($taskId)
    {

        // Obtener desarrolladores asignados a la tarea
        //-------
        $task = Task::find($taskId);
        $taskDevs = $task->getDevelopers();

        // Obtener desarrolladores del proyecto
        //---------
        $taskGroup = TaskGroup::find($task->task_group_id);
        $project = Project::find($taskGroup->project_id);
        $projectDevs = $project->getDevelopers();
        $projectDevsNotAssigned = $projectDevs->diff($taskDevs);



        if( $taskDevs->count() == 0){
            $taskDevs = null;
        }

        if( $projectDevsNotAssigned->count() == 0){
            $projectDevsNotAssigned = null;
        }

        return view(
            'task/mod',
            [
                'task' => $task,
                'taskDevelopers' => $taskDevs,
                'projectDevelopers' => $projectDevsNotAssigned,
            ]
        );
    }

    #endregion

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProjectController;
use App\TaskGroup;
use App\Project;
use Illuminate\Http\Request;

class TaskGroupController extends Controller
{

    /**
     * -----------------------------------------------------------------
     * ---------------------ALTA BAJA MODIFICACION----------------------
     * -----------------------------------------------------------------
     *
     */
    #region GESTION

    /**
     * INSERTAR NUEVO GRUPO DE TAREAS
     * ---------------------------------
     * Recibe un Request con los datos de la vista de crear un nuevo grupo de tareas y el id del proyecto
     * Inserta los datos en las estructuras de BD
     * @param Request $data, el request de la vista
     * @param Integer $projectId, el id del proyecto al que va a pertenecer el grupo
     * @return View ProjectController::view_editProject, la vista de editar proyecto
     */
    protected function create(Request $data, $projectId)
    {

        //Insert in taskgroup table
        $taskGroup = TaskGroup::create([
            'project_id' => $projectId,
            'name' => $data['name'],
            'description' => $data['description'],
            'visble' => TaskGroup::VISIBLE,
        ]);

        //Devolver vista de editar taskgroup
        // $tasks = null;

        // return view(
        //     'taskgroup/mod',
        //     [
        //         'taskGroup' => $taskGroup,
        //         'taskList' => $tasks,
        //         'projectId' => $projectId,
        //     ]
        // );

        //Devolver la vista de mostrar proyecto
        return ProjectController::view_showProject($taskGroup->project_id);




    }

    /**
     * ACTUALIZAR GRUPO DE TAREAS
     * ---------------------------
     * Recibe un Request con los datos de la vista de editar grupo de tareas y el id del grupo de tareas
     * Actualiza las estructuras en BD con los nuevos datos
     * @param Request $data, el request de la vista
     * @param Integer $taskGroupId, el id del grupo de tareas
     * @return View ProjectController::view_editProject, la vista de editar proyecto
     */
    public function updateTaskGroup(Request $data, $taskGroupId)
    {
        $taskGroup = TaskGroup::find($taskGroupId);

        //Udate fields
        $taskGroup->name = $data['name'];
        $taskGroup->description = $data['description'];
        $taskGroup['visible'] = $data['visible'];


        //Update database
        $taskGroup->save();
        return ProjectController::view_showProject($taskGroup->project_id);

    }

    /**
     * ELIMINAR UN GRUPO DE TAREAS
     * ----------------------------
     * Recibe el id de un grupo  de tareas y lo borra de la BD (Invisible)
     * @param Integer $taskGroupId, el id del grupo a eliminar
     * @return View ProjectController::view_editProject, la vista de editar proyecto
     */
    public function deleteTaskGroup($taskGroupId)
    {
        $taskGroup = TaskGroup::find($taskGroupId);
        // $taskGroup->delete();
        $taskGroup['visible'] = 0;
        $taskGroup->save();

        $projectId = $taskGroup->project_id;

        return ProjectController::view_editProject($projectId);
    }

    #endregion

    /**
     * INICIAR TASK GROUP
     * -------------------
     *
     * Si no ha sido iniciado previamente se actualiza en BD
     * la fecha de inicio y el estado
     *
     */
    public static function startTaskGroup($taskGroupId)
    {

        // Actualizar el proyecto en BD (tabla project)
        // Solo si no se ha empezado ya
        $taskGroup = TaskGroup::find($taskGroupId);

        if ($taskGroup->start_date != null && $taskGroup->status == TaskGroup::STATUS_TODO) {

            // Añadir la fecha de inicio al grupo de tareas
            // Actualizar el estado del grupo de tareas a haciendose

            $taskGroup->start_date = Carbon::now()->toDateTimeString();
            $taskGroup->status = TaskGroup::STATUS_DOING;
        }

    }



    /**
     * -----------------------------------------------------------------
     * ---------------------------VISTAS--------------------------------
     * -----------------------------------------------------------------
     *
     */

    #region VISTAS

    /**
     * VISTA CREAR GRUPO DE TAREA
     * ---------------------------
     * Devuelbe la vista de crear un nuevo grupo de tarea
     * @param Integer $projectId, el id del proyecto
     */
    public function view_newTaskGroup($projectId)
    {
        $project = Project::find($projectId);
        return view('taskgroup/new', ['project' => $project]);
    }

    /**
     * VISTA EDITAR GRUPO DE TAREA
     * ----------------------------
     * Devuelbe la vista de editar un grupo de tarea existente
     * @param Integer $taskGroupId, el id del grupo de tarea
     */
    public static function view_editTaskGroup($taskGroupId)
    {
        $taskGroup = TaskGroup::find($taskGroupId);
        $tasks = $taskGroup->tasks;
        if($tasks->count()==0){
            $tasks = null;
        }

        return view(
            'taskgroup/mod',
            [
                'taskGroup' => $taskGroup,
                'taskList' => $tasks,
                'projectId' => $taskGroup->project_id,
            ]
        );

    }

    #endregion

}

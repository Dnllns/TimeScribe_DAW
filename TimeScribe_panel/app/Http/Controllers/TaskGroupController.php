<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProjectController;
use App\TaskGroup;
use Illuminate\Http\Request;

class TaskGroupController extends Controller
{
    //

    protected function create(Request $data, $projectId)
    {

        //Insert in taskgroup table
        $insert = TaskGroup::create([
            'project_id' => $projectId,
            'name' => $data['name'],
            'description' => $data['description'],
            // 'status' => $data['status'],
        ]);

        //Return to the project editor view
        return ProjectController::view_editProject($projectId);

    }

    public function view_newTaskGroup($projectId)
    {

        return view(
            'TaskGroup/Tg_Create',
            [
                'projectId' => $projectId,
            ]
        );

    }

    public static function view_editTaskGroup($taskGroupId)
    {
        $taskGroup = TaskGroup::find($taskGroupId);
        $tasks = $taskGroup->tasks;

        return view(
            'TaskGroup/Tg_Edit',
            [
                'taskGroup' => $taskGroup,
                'taskList' => $tasks,
                'projectId' => $taskGroup->project_id,
            ]
        );

    }

    public function updateTaskGroup(Request $data, $taskGroupId)
    {
        $taskGroup = TaskGroup::find($taskGroupId);

        //Udate fields
        $taskGroup->name = $data['name'];
        $taskGroup->description = $data['description'];

        //Update database
        $taskGroup->save();
        return ProjectController::view_editProject($taskGroup->project_id);

    }

    public function deleteTaskGroup($taskGroupId)
    {
        $taskGroup = TaskGroup::find($taskGroupId);
        $projectId = $taskGroup->project_id;
        $taskGroup->delete();
        return ProjectController::view_editProject($projectId);
    }


  
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




}

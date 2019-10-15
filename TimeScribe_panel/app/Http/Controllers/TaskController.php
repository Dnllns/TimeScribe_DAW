<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Controllers\TaskGroupController;

class TaskController extends Controller
{
    //

    public function view_newTask($taskGroupId)
    {
        return view(
            'Task/Ts_Create', ['taskGroupId' => $taskGroupId,]
        );
    }


    public function view_editTask($taskId)
    {
        $task = Task::find($taskId);
        return view(
            'Task/Ts_Edit', ['task' => $task,]
        );
    }


    protected function create(Request $data, $taskGroupId)
    {
        //Insert in taskgroup table
        $insert = Task::create([
            'task_group_id' => $taskGroupId,
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return TaskGroupController::view_editTaskGroup($taskGroupId);
    }

    
    public function updateTask(Request $data, $taskId)
    {

        $task = Task::find($taskId);

        //Udate fields
        $task->name = $data['name'];
        $task->description = $data['description'];

        //Update database
        $task->save();
        return TaskGroupController::view_editTaskGroup($task->task_group_id);

    }

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);
        $taskgroupId = $task->task_group_id;
        $task->delete();
        return TaskGroupController::view_editTaskGroup($taskgroupId);
    }

}

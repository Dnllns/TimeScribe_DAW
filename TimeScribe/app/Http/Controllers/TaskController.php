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


    public function view_editTask($task)
    {
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
            // 'status' => $data['status'],
        ]);

        return TaskGroupController::view_editTaskGroup($taskGroupId);
    }

}

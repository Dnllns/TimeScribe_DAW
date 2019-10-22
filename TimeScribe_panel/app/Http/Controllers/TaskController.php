<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TaskGroupController;
use App\Http\Controllers\ProjectController;

use App\Task;
use App\Project;
use App\TimeRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //

    public function view_newTask($taskGroupId)
    {
        return view(
            'Task/Ts_Create', ['taskGroupId' => $taskGroupId]
        );
    }

    public function view_editTask($taskId)
    {
        $task = Task::find($taskId);
        return view(
            'Task/Ts_Edit', ['task' => $task]
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
        // $task = Task::find($taskId);
        // $taskgroupId = $task->task_group_id;
        // $task->delete();
        // return TaskGroupController::view_editTaskGroup($taskgroupId);

        $task = Task::find($taskId);
        $task->visible = Task::INVISIBLE;
        $task->save();
        
    }

    public function f()
    {
        echo "aaa";
    }

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


    public function startNewTask($taskId)
    {
        $task = Task::find($taskId);
        $task->start_date = Carbon::now()->toDateTimeString();
        $task->status = Task::STATUS_DOING;
        $task->save();
    }


    public function setDone($taskId){

        $task = Task::find($taskId);
        $task->status = Task::STATUS_DONE;
        $task->finish_date = Carbon::now()->toDateTimeString();
        $task->save();

        // return ProjectController::view_selectProject();
    
    }



}

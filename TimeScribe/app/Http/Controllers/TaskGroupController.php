<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskGroup;

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


    }



    public function view_editTaskGroup($taskGroupId){

        $taskGroup = TaskGroup::find($taskGroupId);

        return view(
            'TaskGroup/createtask',
            [
                'taskGroup' => $taskGroup,
            ]
        );

    }



    // public function view_editProject($projectId)
    // {
    //     $project = Project::find($projectId);
    //     $client = User::find($project->client_id);
    //     return view(
    //         'project/edit',
    //         [
    //             'project' => $project,
    //             'client' => $client,
    //         ]
    //     );

    // }

}

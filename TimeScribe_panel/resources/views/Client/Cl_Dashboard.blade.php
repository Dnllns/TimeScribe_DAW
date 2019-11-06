@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">





        <h1>Project list</h1>

        <!-- DROPDOWN SELECT PROJECT -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Select project
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                @foreach ($clientProjects as $project)
                <a class="dropdown-item" href="#project_{{$project->id}}">{{ $project->name }}</a>
                @endforeach

            </div>
        </div>


        @foreach ($clientProjects as $project)

        <!-- Project INFO -->
        <div id="project_{{$project->id}}" class="my-group">

            <h3>{{ $project->name }}</h3>
            <p>{{ $project->description }}</p>

            <!-- <p>Created by {{-- $project->getCreator() --}}</p> -->




            <label for="pbar">Project % completed:</label>

            <!-- Progress bar -->
            <div name="pbar" class="progress">
                <div role="progressbar" aria-valuenow="{{$project->getPercentCompleted()}}"
                aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-striped bg-success progress-bar-animated"
                style="width: {{$project->getPercentCompleted()}}%;">{{$project->getPercentCompleted()}}%</div>
            </div>

            <button type="button" class="btn btn-info mt-4" data-toggle="collapse" data-target="#task_groups_{{$project->id}}">
                <i class="far fa-eye icon-white"></i>
            </button>

            <!-- TASKGROUPS -->
            <div id="task_groups_{{$project->id}}" class="collapse mt-4">

                @foreach ($project->taskgroups as $taskGroup)
                <div id="task_group_{{$taskGroup->id}}">
                    <p> {{$taskGroup->name}}</p>

                    <ul>
                        @foreach ($taskGroup->tasks as $task)
                        <li>{{$task->name}} {{$task->getStatusIcon()}} </li>
                        @endforeach

                    </ul>



                </div>
                @endforeach

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection

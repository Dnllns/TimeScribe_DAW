@extends('layouts.app')

@section('head')

    <!-- STYLES -->
    <link rel="stylesheet" href="/JqueryUi/jquery-ui.min.css">
    <link rel="stylesheet" href="/JqueryUi/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="/JqueryUi/jquery-ui.theme.min.css">

    <!-- LIBS -->
    <script src="/js/jquery-3.4.1.js"></script>
    <script src="/JqueryUi/jquery-ui.min.js"></script>
    
    <!-- -------------SCRIPTS---------------- -->
    <script src="/js/pr_dashboard/funcionesComunes.js"></script>
    <!-- Primero las peticiones al server -->
    <script src="/js/pr_dashboard/ajax_updates.js"></script>
    <script src="/js/pr_dashboard/chrono.js"></script>
    <!-- Para hacer drag and drop -->
    <script src="/js/pr_dashboard/draggable.js"></script>

@endsection


@section('content')

<div class="content">

    <!-- Plantilla de sticky chrono -->
    @include('task.partials.StickyChrono')

    <div class="container">

        <h2>{{ $project->name }}</h2>
        <p>{{ $project->description }}</p>
        <br>

    </div>

    @foreach ($taskGroups as $taskGroup)


        <div class="container-fluid my-group rounded ">

            <!-- TASKGROUP INFO -->
            <div class="column">

                <h3>{{ $taskGroup->name }}</h3>
                <p>{{ $taskGroup->description }}</p>
                <label for="pbar">Taskgroup % completed:</label>

                <!-- Progress bar -->
                <div name="pbar" class="progress">
                    <div role="progressbar" aria-valuenow="{{$taskGroup->getPercentCompleted()}}"
                    aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-striped bg-success progress-bar-animated"
                    style="width: {{$taskGroup->getPercentCompleted()}}%;">{{$taskGroup->getPercentCompleted()}}%</div>
                </div>

                <button type="button" class="btn btn-info mt-4" data-toggle="collapse" data-target="#task_container">
                   <i class="far fa-eye icon-white"></i>
                </button>

            </div>
 
            <!-- COLLAPSE DIV TAREAS -->
            <div id="task_container" class="mt-4 collapse">

                <div id="task_list" class="d-flex flex-nowrap justify-content-around ">


                    <!-- TAREAS POR HACER -->
                    <div id="todo_task" class="dragg-container col-sm-3 border border-fat border-warning rounded todo">
                        
                        <h4>To do</h4>
                        
                        <!-- PLANTILLA DE TAREA -->
                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_TODO) as $task)
                            @include('task.partials.PL_Task', ['status' => $taskGroup::STATUS_TODO ])
                        @endforeach

                    </div>

                    <!-- TAREAS HACIENDOSE -->
                    <div id="doing_task" class="dragg-container col-sm-4 border border-fat border-info rounded doing">
                        <h4>Doing</h4>

                        <!-- Plantilla de tarea -->
                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_DOING) as $task)
                            @include('task.partials.PL_Task', ['status' => $taskGroup::STATUS_DOING ])
                        @endforeach

                    </div>


                    <!-- TAREAS HECHAS -->
                    <div id="done" class="dragg-container col-sm-4 border border-fat border-success rounded done">
                        <h4>Done</h4>

                        <!-- Plantilla de tarea -->
                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_DONE) as $task)     
                            @include('task.partials.PL_Task', ['status' => $taskGroup::STATUS_DONE ])
                        @endforeach

                    </div>
                    
                </div>
            </div>

        </div>

    @endforeach


</div>

@endsection








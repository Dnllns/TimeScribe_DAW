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
                        <div id="task_{{$task->id}}" class="item card border-fat shadow mb-4 item py-2">
                            
                            <div class="card-body d-flex flex-row">

                                <!-- CABECERA -->
                                <div class="no-gutters align-items-center col-sm-11">
                                    <div class="col mr-2">
                                        <div id="t_name_{{$task->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>
                                    </div>
                                </div>
                                <!-- BOTONES -->
                                <div class="d-flex flex-column col-sm-1">

                                    <!-- BOTON DE START -->
                                    <button id="b_startnew_{{$task->id}}" type="button" class="btn btn-success btn-circle col-sm-1" data-toggle="tooltip" data-placement="bottom" title="Start task">
                                        <i class="far fa-play-circle icon-white"></i>
                                    </button>

                                </div>
                            </div>

                        </div>
                        @endforeach

                    </div>

                    <!-- TAREAS HACIENDOSE -->
                    <div id="doing_task" class="dragg-container col-sm-4 border border-fat border-info rounded doing">
                        <h4>Doing</h4>

                        <!-- Plantilla de tarea -->
                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_DOING) as $task)
                        <div id="task_{{$task->id}}" class="item card border-fat shadow mb-4 item py-2">
                            
                            <div class="card-body d-flex flex-row">

                                                                
                                <!-- CABECERA -->
                                <div class="col-sm-11 no-gutters align-items-center ">
                                    
                                    <!-- TITULO Y DESCRIPCION -->
                                    <div id="t_name_{{$task->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>
                                    

                                    <!-- TASK DATA -->
                                    <div id="taskcontent_{{$task->id}}" class="col mr-2 pt-4 collapse">

                                        <div class="d-flex ">
                                            <i class="fas fa-business-time pr-3" data-toggle="tooltip" data-placement="bottom" title="Worked time"></i>
                                            <p>{{ $task->getWorkedTime() }}</p>
                                        </div>

                                        <div class="d-flex">
                                            <i class="fas fa-calendar-day pr-3" data-toggle="tooltip" data-placement="bottom" title="Start date"></i>
                                            <p>{{ $task->start_date }}</p>
                                        </div>

                                    </div>

                                </div>

                                <!-- BOTONES -->
                                <div class="d-flex flex-column col-sm-1">

                                    <!-- BOTON DE VISUALIZAR -->
                                    <button type="button" class="btn btn-info btn-circle btn-sm " data-toggle="collapse" data-target="#taskcontent_{{$task->id}}">
                                        <i class="far fa-eye icon-white"></i>
                                    </button>
                                    <!-- START/STOP/RESUME -->
                                    <button type="button" id="b_doing_select_{{$task->id}}" class="btn btn-primary btn-circle btn-sm mt-2" f="chronoStart" data-toggle="tooltip" data-placement="bottom" title="Select task">
                                        <i class="fas fa-stopwatch icon-white"></i>
                                    </button>
                                    <!-- COMPLETED BUTTON -->
                                    <button type="button" id="b_done_{{$task->id}}" class="btn btn-success btn-circle btn-sm mt-2"  data-toggle="tooltip" data-placement="bottom" title="Set done">
                                        <i class="far fa-check-circle icon-white"></i>
                                    </button>

                                </div>

                            </div>

                        </div>
                        @endforeach

                    </div>


                    <!-- TAREAS HECHAS -->
                    <div id="done" class="dragg-container col-sm-4 border border-fat border-success rounded done">
                        <h4>Done</h4>

                        <!-- Plantilla de tarea -->
                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_DONE) as $task)     

                            <!-- Incluir la plantilla de tarea, Task.PL_Task -->

                            <!-- TITULO DE LA TAREA -->
                            <div id="task_{{$task->id}}" class="item card border-fat shadow mb-4 item py-2">

                                <div class="card-body d-flex flex-row">

                                
                                    <!-- CABECERA -->
                                    <div class="col-sm-11 no-gutters align-items-center ">

                                        <!-- TITULO Y DESCRIPCION -->
                                        <div id="t_name_{{$task->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>


                                        <!-- TASK DATA -->
                                        <div id="taskcontent_{{$task->id}}" class="col mr-2 pt-4 collapse">

                                            <div class="d-flex ">
                                                <i class="fas fa-business-time pr-3" data-toggle="tooltip" data-placement="bottom" title="Worked time"></i>
                                                <p>{{ $task->getWorkedTime() }}</p>
                                            </div>

                                            <div class="d-flex">
                                                <i class="fas fa-calendar-day pr-3" data-toggle="tooltip" data-placement="bottom" title="Start date"></i>
                                                <p>{{ $task->start_date }}</p>
                                            </div>

                                            <div class="d-flex">
                                                <i class="fas fa-calendar-check pr-3" data-toggle="tooltip" data-placement="bottom" title="Finish date"></i>
                                                <p>{{ $task->finish_date }}</p>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- BOTONES -->
                                    <div class="d-flex flex-column col-sm-1">

                                        
                                        <!-- BOTON DE VISUALIZAR -->
                                        <button type="button" class="btn btn-info btn-circle btn-sm" data-toggle="collapse" data-target="#taskcontent_{{$task->id}}">
                                            <i class="far fa-eye icon-white"></i>
                                        </button>
                                        <!-- BOTON DE ELIMINAR -->
                                        <button id="remove_task_{{$task->id}}" type="button"class="btn btn-danger btn-circle btn-sm mt-2" data-toggle="tooltip" data-placement="bottom" title="Remove task">
                                            <i class="far fa-trash-alt icon-white"></i>
                                        </button>

                                    </div>

                                </div>
                            </div>

                        @endforeach

                    </div>
                    
                </div>
            </div>

        </div>

    @endforeach


</div>

@endsection








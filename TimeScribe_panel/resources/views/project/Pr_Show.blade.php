@extends('layouts.app')

@section('head')


    <!-- -----------------LIBRARYS----------------- -->
    <!-- JQUERY UI -->
    <script src="/js/JQueryUi/jquery-ui.min.js"></script>
    <link href="/css/JQueryUi/jquery-ui.min.css" rel="stylesheet" type="text/css">



@endsection


@section('content')

<div class="content">

    <!-- STICKY CHRONO -->
    <div id="sticky-chrono" class="sticky-chrono row justify-content-around d-none">


        <div class="m-2">
            <!-- <label for="task_name">Doing task:</label> -->
            <p id="task_name" class="font-weight-bold"></p>
        </div>
        <!-- CHRONO -->
        <div class="m-2">
            <!-- <label for="chronotime">Elapsed time:</label> -->
            <p id="chronotime" class="chrono font-weight-bold">00:00:00</p>
        </div>
        <!-- BOTONES -->
        <div class="my-auto">

            <!-- START/STOP/RESUME -->
            <button type="button" id="b_start" class="btn btn-primary btn-icon-split" f="chronoStart">
                <span id="" class="icon text-white-50"><i class="far fa-clock icon-white"></i></span>
                <span id="" class="text">Start counting time</span>
            </button>

            <!-- RESET -->
            <button type="button" id="b_reset" class="ml-2 btn btn-danger btn-icon-split d-none" >
                <span id="" class="icon text-white-50"><i class="fas fa-undo icon-white"></i></span>
                <span id="" class="text">Reset time</span>
            </button>

        </div>

        <button id="x" class="btn" type="button">X</button>



    </div>


    <div class="container">

        <h2>{{ $project->name }}</h2>
        <p>{{ $project->description }}</p>
        <br>


    </div>

    @foreach ($taskGroups as $taskGroup)


        <div class="container-fluid my-container task-group rounded ">

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

                <button type="button" class="btn btn-info mt-4" data-toggle="collapse" data-target="#task_container">Show task list</button>

            </div>
 
            <!-- COLLAPSE DIV TAREAS -->
            <div id="task_container" class="mt-4 collapse">

                <div id="task_list" class="d-flex flex-nowrap justify-content-around ">

                    <!-- TAREAS POR HACER -->
                    <div id="todo_task" class="dragg-container col-sm-3 border border-fat border-warning rounded todo">
                        <h4>To do</h4>

                        <!-- PLANTILLA DE TAREA -->
                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_TODO) as $task)
                        <div id="task_{{$task->id}}" class="card border-fat shadow mb-4 item py-2">

                            <div class="card-body">

                                <div class="no-gutters align-items-center">
                                    <!-- CABECERA -->
                                    <div class="col mr-2">
                                        <div id="t_name_{{$task->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>
                                    </div>
                                </div>

                                <!-- START TASK BUTTON -->
                                <button id="b_startnew_{{$task->id}}" type="button" class="btn btn-success mt-3" data-toggle="tooltip" data-placement="bottom" title="Start task">
                                    <i class="far fa-play-circle icon-white"></i>
                                </button>

                            </div>

                        </div>
                        @endforeach

                    </div>

                    <!-- TAREAS HACIENDOSE -->
                    <div id="doing_task" class="dragg-container col-sm-4 border border-fat border-info rounded doing">
                        <h4>Doing</h4>

                        <!-- Plantilla de tarea -->
                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_DOING) as $task)
                        <div id="task_{{$task->id}}" class="card border-fat shadow mb-4 item py-2">

                            <div class="card-body">

                                <div class="item-move">MOVE</div>
                                
                                <!-- CABECERA -->
                                <div class="col no-gutters align-items-center ">
                                    
                                    <!-- BOTON DE VISUALIZAR -->
                                    <button type="button" class="btn btn-info btn-circle btn-sm float-right" data-toggle="collapse" data-target="#taskcontent_{{$task->id}}">
                                        <span class="icon text-white-50">
                                            <i class="far fa-eye icon-white"></i>
                                        </span>
                                    </button>
                                    
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

                                <!-- BUTTONS -->
                                <div class="row pt-2 pl-3 col-sm-12">
                                    <!-- START/STOP/RESUME -->
                                    <button type="button" id="b_select_{{$task->id}}" class="btn btn-primary btn-icon-split mr-2" f="chronoStart" data-toggle="tooltip" data-placement="bottom" title="Select task">
                                        <i class="fas fa-stopwatch icon-white"></i>
                                    </button>
                                    <!-- COMPLETED BUTTON -->
                                    <button type="button" id="b_done_{{$task->id}}" class="btn btn-success btn-icon-split" href="{{ route('rt_pr_update', $project->id) }}" data-toggle="tooltip" data-placement="bottom" title="Set done">
                                        <i class="far fa-check-circle icon-white"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                        @endforeach

                    </div>


                    <!-- TAREAS HECHAS -->
                    <div class="dragg-container col-sm-4 border border-fat border-success rounded done">
                        <h4>Done</h4>

                        <!-- Plantilla de tarea -->
                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_DONE) as $task)          
                        <div id="task_{{$task->id}}" class="card border-fat shadow mb-4 item py-2">

                            <div class="card-body">

                                <div class="item-move">MOVE</div>
                                
                                <!-- CABECERA -->
                                <div class="column no-gutters align-items-center ">
                                    
                                    <!-- BOTON DE VISUALIZAR -->
                                    <button type="button" class="btn btn-info btn-circle btn-sm float-right" data-toggle="collapse" data-target="#taskcontent_{{$task->id}}">
                                        <span class="icon text-white-50">
                                            <i class="far fa-eye icon-white"></i>
                                        </span>
                                    </button>
                                    
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

                                <!-- BUTTONS -->
                                <div class="row pt-2 pl-3 col-sm-12">
                                    <button id="remove_task_{{$task->id}}" type="button"class="btn btn-danger btn-icon-split" data-toggle="tooltip" data-placement="bottom" title="Remove task">
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

@section('js_libs')

<script src="/js/pr_dashboard/chrono.js"></script>
<script src="/js/pr_dashboard/ajax_updates.js"></script>
<script src="/js/pr_dashboard/draggable.js"></script>



@endsection

@extends('layouts.app')

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




        @foreach ($taskGroups as $taskGroup)


            <div class="">

                <h3>{{ $taskGroup->name }}</h3>
                <p>{{ $taskGroup->description }}</p>
                <label for="pbar">Taskgroup % completed:</label>
                <div name="pbar" class="progress">
                    <div role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar" style="width: 25%;">25%</div>
                </div>
                <br>
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#task_container">Show task list</button>


                <br>
                <br>

                
                
                <div id="task_container" class="my-container collapse">

                    <div id="task_list" class="d-flex column">


                        <!-- TAREAS POR HACER -->
                        <div id="todo_task" class="my-container col-sm-4 border border-fat border-warning rounded todo">
                            <h4>To do</h4>
                            <br>

                            @foreach ($taskGroup->getTasks($taskGroup::STATUS_TODO) as $task)

                                <!-- Plantilla de tarea -->

                                <div id="task_{{$task->id}}" class="mb-4">
                                    <div class="card border-fat shadow h-100 py-2">
                                        <div class="card-body">

                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div id="t_name_{{$task->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>
                                                </div>
                                                

                                            </div>
                                            <div class="pt-3">
                                                <button id="b_startnew_{{$task->id}}" type="button" class="btn btn-success btn-icon-split"
                                                data-toggle="tooltip" data-placement="bottom" title="Start task">

                                                    <span class="icon text-white-50">
                                                        <i class="far fa-play-circle icon-white"></i>
                                                    </span>
                                                    <!-- <span class="text">Start task</span> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                        <br>

                        <!-- TAREAS HACIENDOSE -->
                        <div class="my-container col-sm-4 border border-fat border-info rounded doing">

                            <h4>Doing</h4>
                            <br>
                            <div class="">

                                @foreach ($taskGroup->getTasks($taskGroup::STATUS_DOING) as $task)

                                    <!-- Plantilla de tarea -->
                                    <div id="task_{{$task->id}}" class="mb-4">
                                        <div class="card border-fat shadow h-100 py-2">

                                            <div class="card-body">

                                                <div class="column no-gutters align-items-center ">

                                                    <!-- TASK HEADDER -->
                                                    <div class="col mr-2">
                                                        <button type="button" class="btn btn-info btn-circle btn-sm float-right" data-toggle="collapse" data-target="#taskcontent_{{$task->id}}">
                                                            <span class="icon text-white-50">
                                                                <i class="far fa-eye icon-white"></i>
                                                            </span>
                                                        </button>
                                                        <div id="t_name_{{$task->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>
                                                    </div>

                                                    <div id="taskcontent_{{$task->id}}" class="collapse">

                                                        <!-- TASK DATA -->
                                                        <ul>
                                                            <li>
                                                                Total time worked
                                                                <p>{{ $task->getWorkedTime() }}</p>
                                                            </li>
                                                            <li>
                                                                Start date
                                                                <p>{{ $task->start_date }}</p>
                                                            </li>
                                                        </ul>



                                                    </div>


                                                    <div class="row pt-3 pl-3 col-sm-12">



                                                        <!-- START/STOP/RESUME -->
                                                        <button type="button" id="b_select_{{$task->id}}" class="btn btn-primary btn-icon-split mr-2" f="chronoStart" 
                                                        data-toggle="tooltip" data-placement="bottom" title="Select task">

                                                            <span class="icon text-white-50"><i class="fas fa-stopwatch icon-white"></i></span>
                                                            <!-- <span class="text">Select task</span> -->
                                                        </button>

                                                        <!-- COMPLETED BUTTON -->
                                                        <button type="button" id="b_done_{{$task->id}}" class="btn btn-success btn-icon-split" href="{{ route('rt_pr_update', $project->id) }}"
                                                        data-toggle="tooltip" data-placement="bottom" title="Set done">
                                                            <span class="icon text-white-50 icon-white"><i class="far fa-check-circle icon-white"></i></span>
                                                            <!-- <span class="text">Set completed</span> -->
                                                        </button>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        </div>

                        <br>

                        <!-- TAREAS HECHAS -->
                        <div class="my-container col-sm-4 border border-fat border-success rounded done">
                            <h4>Done</h4>
                            <br>

                            @foreach ($taskGroup->getTasks($taskGroup::STATUS_DONE) as $task)
                                <!-- Plantilla de tarea -->

                                <div class="mb-4">
                                    <div class="card border-fat shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="column no-gutters align-items-center">
                                                
                                                <!-- TASK HEADDER -->
                                                <div class="col mr-2">
                                                    <button type="button" class="btn btn-info btn-circle btn-sm float-right" data-toggle="collapse" data-target="#taskcontent_{{$task->id}}">
                                                        <span class="icon text-white-50">
                                                            <i class="far fa-eye icon-white"></i>
                                                        </span>
                                                    </button>
                                                    <div id="t_name_{{$task->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>
                                                </div>

                                                <div id="taskcontent_{{$task->id}}" class="collapse">

                                                    <!-- TASK DATA -->
                                                    <ul>
                                                        <li>
                                                            Total time worked
                                                            <p>{{ $task->getWorkedTime() }}</p>
                                                        </li>
                                                        <li>
                                                            Start date
                                                            <p>{{ $task->start_date }}</p>
                                                        </li>
                                                        <li>
                                                            Finish date
                                                            <p>{{ $task->finish_date }}</p>
                                                        </li>
                                                    </ul>

                                                </div>

                                                <div class="mt-4">
                                                    <button id="remove_task_{{$task->id}}" type="button"class="btn btn-danger btn-icon-split"
                                                    data-toggle="tooltip" data-placement="bottom" title="Remove task">

                                                        <span class="icon text-white-50">
                                                            <i class="far fa-trash-alt icon-white"></i>                                                        </span>
                                                        <!-- <span class="text">Remove task</span> -->
                                                    </button>
                                                </div>

                                            </div>
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



</div>

@endsection

@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src="/js/pr_dashboard/chrono.js"></script>
    <script src="/js/pr_dashboard/ajax_updates.js"></script>
@endsection

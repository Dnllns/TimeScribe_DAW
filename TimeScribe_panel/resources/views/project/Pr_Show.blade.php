@extends('layouts.app')

@section('content')

<div class="content">


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
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#task_list">Show task list</button>


                <br>
                <br>
                <div id="task_list" class="container collapse">





                    <!-- TAREAS POR HACER -->
                    <div class="col-sm-12 border border-fat border-warning container rounded todo">
                        <h4>To do</h4>
                        <br>

                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_TODO) as $task)

                            <!-- Plantilla de tarea -->

                            <div class="col-md-6 mb-4">
                                <div class="card border-left-primary border-fat shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>
                                            </div>
                                            <div class="mt-4">
                                                <a href="#" class="btn btn-success btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="far fa-play-circle"></i>
                                                    </span>
                                                    <span class="text">Start task</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                    <br>

                    <!-- TAREAS HACIENDOSE -->
                    <div class="col-sm-12 border border-fat border-info container rounded doing">
                        <h4>Doing</h4>
                        <br>
                        <div class="d-flex flex-wrap">
                            @foreach ($taskGroup->getTasks($taskGroup::STATUS_DOING) as $task)
                                <!-- Plantilla de tarea -->


                                <div id="task_{{$task->id}}" class="col-md-6 mb-4">
                                    <div class="card border-left-primary border-fat shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="column no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>
                                                </div>

                                                <br>
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

                                                <!-- PROGRESS BAR -->
                                                <!-- <h4 class="small font-weight-bold">% completed task<span class="float-right">20%</span></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div> -->


                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        Worked time today
                                                    </div>
                                                    <div class="card-body d-flex justify-content-center">

                                                        <p id="chronotime_{{$task->id}}" class="chrono font-weight-bold">00:00:00</p>

                                                    </div>
                                                </div>

                                                <!-- BOTONES -->
                                                <div class="row pl-3">

                                                    <!-- START/STOP/RESUME -->
                                                    <button id="b_start_{{$task->id}}"
                                                        class="btn btn-success btn-icon-split"
                                                        onclick="chronoStart(event)">

                                                        <span class="icon text-white-50">
                                                            <i class="far fa-clock"></i>                                                        </span>
                                                        <span class="text">Start counting time</span>
                                                    </button>

                                                    <!-- RESET -->
                                                    <button id="b_reset_{{$task->id}}"
                                                        class="ml-2 btn btn-danger btn-icon-split d-none"
                                                        onclick="">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-undo-alt"></i>                                                       </span>
                                                        <span class="text">Reset time</span>
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
                    <div class="col-sm-12 border border-fat border-success container rounded done">
                        <h4>Done</h4>
                        <br>

                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_DONE) as $task)
                            <!-- Plantilla de tarea -->

                            <div class="col-md-6 mb-4">
                                    <div class="card border-left-primary border-fat shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="column no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>
                                                </div>

                                                <br>
                                                <ul>
                                                    <li>
                                                        Time worked
                                                        <p></p>
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

                                                <div class="mt-4">
                                                    <a href="#" class="btn btn-danger btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="far fa-trash-alt"></i>                                                        </span>
                                                        <span class="text">Remove task</span>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                        @endforeach
                    </div>
                </div>
            </div>

        @endforeach

    </div>



</div>

@endsection

@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src="/js/chrono/chrono.js"></script>
@endsection

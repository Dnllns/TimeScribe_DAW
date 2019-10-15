@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <h2>{{ $project->name }}</h2>
        <p>{{ $project->description }}</p>
        <br>




        @foreach ($taskGroups as $taskGroup)


            <div class="container">

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
                    <div class="col-sm-12 border border-fat border-warning container rounded">
                        <h4>To do</h4>
                        <br>

                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_TODO) as $task)

                            <!-- Plantilla de tarea -->
                            <div class="container border border-primary rounded bg-light ">
                                <div class="">
                                    <h5>{{ $task->name }}</h5>
                                    <p>{{ $task->description }}</p>
                                </div>

                                <a href="#" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="far fa-play-circle"></i>
                                    </span>
                                    <span class="text">Start task</span>
                                </a>

                            </div>
                            <br>

                        @endforeach

                    </div>
                    <br>


                    <!-- TAREAS HACIENDOSE -->
                    <div class="col-sm-12 border border-fat border-info container rounded">
                        <h4>Doing</h4>
                        <br>
                        <div class="d-flex col-md-offset-2">
                            @foreach ($taskGroup->getTasks($taskGroup::STATUS_DOING) as $task)
                                <!-- Plantilla de tarea -->
                                <div class="container col-sm-6 border border-primary rounded bg-light">

                                    <div class="">
                                        <h5>{{ $task->name }}</h5>
                                        <p>{{ $task->description }}</p>
                                    </div>

                                    <ul>
                                        <li>
                                            Time worked
                                            <p></p>
                                        </li>
                                        <li>
                                            Start date
                                            <p>{{ $task->start_date }}</p>
                                        </li>
                                    </ul>

                                    <!-- PROGRESS BAR -->
                                    <h4 class="small font-weight-bold">% completed task<span class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <!-- RESUME TASK BUTTON -->
                                    <a href="#" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="far fa-clock"></i>
                                        </span>
                                        <span class="text">Resume counting time</span>
                                    </a>

                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>
                    <br>

                    <!-- TAREAS HECHAS -->
                    <div class="col-sm-12 border border-fat border-success container rounded">
                        <h4>Done</h4>
                        <br>

                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_DONE) as $task)
                            <!-- Plantilla de tarea -->
                            <div class="container border border-primary rounded bg-light">

                                <h5>{{ $task->name }}</h5>
                                <p>{{ $task->description }}</p>

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

                            </div>
                            <br>
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
    <script src=""></script>
@endsection

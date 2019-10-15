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
                    <div class="bg-warning container rounded">
                        <h4>To do</h4>
                        <br>
                        
                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_TODO) as $task)

                            <!-- Plantilla de tarea -->
                            <div class="container border border-primary rounded bg-light ">
                                <div class="">
                                    <h5>{{ $task->name }}</h5>
                                    <p>{{ $task->description }}</p>
                                </div>
                                <div class="">
                                    <a class="btn btn-primary">Start task</a>
                                </div>
                            </div>
                            <br>

                        @endforeach
                    
                    </div>
                    <br>


                    <!-- TAREAS HACIENDOSE -->
                    <div class="bg-info container rounded">
                        <h4>Doing</h4>
                        <br>

                        @foreach ($taskGroup->getTasks($taskGroup::STATUS_DOING) as $task)
                            <!-- Plantilla de tarea -->
                            <div class="container border border-primary rounded bg-light">     

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


                                <label for="pbar">% completed task</label>
                                <div name="pbar" class="progress">
                                    <div role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar" style="width: 25%;">25%</div>
                                </div>
                                
                                <br>
                                <div class="">
                                    <a class="btn btn-primary">Resume counting time</a>
                                </div>


                            </div>
                            <br>
                        @endforeach
                
                    </div>
                    <br>

                    <!-- TAREAS HECHAS -->
                    <div class="bg-success container rounded">
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

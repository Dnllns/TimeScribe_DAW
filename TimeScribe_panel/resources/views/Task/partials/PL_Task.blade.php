
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

            @switch($status)
   
                @case($taskGroup::STATUS_DOING)
                    <div class="d-flex ">
                        <i class="fas fa-business-time pr-3" data-toggle="tooltip" data-placement="bottom" title="Worked time"></i>
                        <p>{{ $task->getWorkedTime($task->id) }}</p>
                    </div>

                    <div class="d-flex">
                        <i class="fas fa-calendar-day pr-3" data-toggle="tooltip" data-placement="bottom" title="Start date"></i>
                        <p>{{ $task->start_date }}</p>
                    </div>
                    @break

                @case($taskGroup::STATUS_DONE)
                    <div class="d-flex ">
                        <i class="fas fa-business-time pr-3" data-toggle="tooltip" data-placement="bottom" title="Worked time"></i>
                        <p>{{ $task->getWorkedTime($task->id) }}</p>
                    </div>

                    <div class="d-flex">
                        <i class="fas fa-calendar-day pr-3" data-toggle="tooltip" data-placement="bottom" title="Start date"></i>
                        <p>{{ $task->start_date }}</p>
                    </div>

                    <div class="d-flex">
                        <i class="fas fa-calendar-check pr-3" data-toggle="tooltip" data-placement="bottom" title="Finish date"></i>
                        <p>{{ $task->finish_date }}</p>
                    </div>

                    @break

            @endswitch

            </div>

        </div>

        <!-- BOTONES -->
        <div class="d-flex flex-column col-sm-1">

            @switch($status)
                @case($taskGroup::STATUS_TODO)
                    <!-- BOTON DE START -->
                    <button id="b_startnew_{{$task->id}}" type="button" class="btn btn-success btn-circle col-sm-1" data-toggle="tooltip" data-placement="bottom" title="Start task">
                        <i class="far fa-play-circle icon-white"></i>
                    </button>
                    @break

                @case($taskGroup::STATUS_DOING)
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
                    @break

                @case($taskGroup::STATUS_DONE)
                    <!-- BOTON DE VISUALIZAR -->
                    <button type="button" class="btn btn-info btn-circle btn-sm" data-toggle="collapse" data-target="#taskcontent_{{$task->id}}">
                        <i class="far fa-eye icon-white"></i>
                    </button>
                    <!-- BOTON DE ELIMINAR -->
                    <button id="remove_task_{{$task->id}}" type="button"class="btn btn-danger btn-circle btn-sm mt-2" data-toggle="tooltip" data-placement="bottom" title="Remove task">
                        <i class="far fa-trash-alt icon-white"></i>
                    </button>
                    @break

            @endswitch

        </div>

    </div>

</div>







<!-- TITULO DE LA TAREA -->
<div data-taskid="{{$task->id}}" class="item card border-fat shadow mb-4 item py-2">

    <div class="card-body d-flex flex-row">


        <!-- CABECERA -->
        <div class="col-sm-11 no-gutters align-items-center ">

            <!-- TITULO Y DESCRIPCION -->
            <div data-chronofunt="taskname" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                {{ $task->name }}
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>


            <!-- TASK DATA -->
            <div class="col mr-2 pt-4 collapse collapse-task-data">

                <div class="d-flex"
                    data-tooltip="tooltip" data-placement="bottom" title="Worked time">
                    <i class="fas fa-business-time pr-3"></i>
                    <p>{{ $task->getWorkedTime($task->id) }}</p>
                </div>

                <div class="d-flex"
                    data-tooltip="tooltip" data-placement="bottom" title="Start date">
                    <i class="fas fa-calendar-day pr-3"></i>
                    <p>{{ $task->start_date }}</p>
                </div>

                @if($status == $taskGroup::STATUS_DONE)
                    <div class="d-flex">
                        <i class="fas fa-calendar-check pr-3" 
                        data-tooltip="tooltip" data-placement="bottom" title="Finish date"></i>
                        <p>{{ $task->finish_date }}</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- BOTONES -->
        <div class="d-flex flex-column col-sm-1">

            @switch($status)
                @case($taskGroup::STATUS_TODO)
                    <!-- BOTON DE START -->
                    <button 
                        data-funct="start"
                        type="button" class="btn btn-success btn-circle col-sm-1" 
                        data-tooltip="tooltip" data-placement="bottom" title="Start task">
                        <i class="far fa-play-circle icon-white"></i>
                    </button>
                    @break

                @case($taskGroup::STATUS_DOING)
                    <!-- BOTON DE VISUALIZAR -->
                    <button 
                        data-funct="view"
                        type="button" class="btn btn-info btn-circle btn-sm "
                        data-tooltip="tooltip" data-placement="bottom" title="View task"
                        data-toggle="collapse" data-target="$(this).closest('.collapse-task-data')">
                        <i class="far fa-eye icon-white"></i>
                    </button>
                    <!-- BOTON DE SELECT -->
                    <button 
                        data-funct="select" data-chronofunct="start"
                        type="button"  class="btn btn-primary btn-circle btn-sm mt-2" 
                        data-tooltip="tooltip" data-placement="bottom" title="Select task">
                        <i class="fas fa-stopwatch icon-white"></i>
                    </button>
                    <!-- BOTON DE COMPLETADO -->
                    <button
                        data-funct="done" 
                        type="button" class="btn btn-success btn-circle btn-sm mt-2" 
                        data-tooltip="tooltip" data-placement="bottom" title="Set done">
                        <i class="far fa-check-circle icon-white"></i>
                    </button>
                    @break

                @case($taskGroup::STATUS_DONE)
                    <!-- BOTON DE VISUALIZAR -->
                    <button
                        data-funct="view"
                        type="button" class="btn btn-info btn-circle btn-sm" 
                        data-toggle="collapse" data-target="$(this).closest('.collapse-task-data')">
                        <i class="far fa-eye icon-white"></i>
                    </button>
                    <!-- BOTON DE ELIMINAR -->
                    <button 
                        type="button"class="btn btn-danger btn-circle btn-sm mt-2" 
                        data-tooltip="tooltip" data-placement="bottom" title="Remove task">
                        <i class="far fa-trash-alt icon-white"></i>
                    </button>
                    @break

            @endswitch

        </div>

    </div>

</div>

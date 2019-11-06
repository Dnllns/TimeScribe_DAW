
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
            <div id="task-data-{{$task->id}}" class="col mr-2 pt-4 collapse">

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

                @if($task->status == $task::STATUS_DONE)
                    <div class="d-flex"
                        data-tooltip="tooltip" data-placement="bottom" title="Finish date">
                        <i class="fas fa-calendar-check pr-3"></i>
                        <p>{{ $task->finish_date }}</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- BOTONES -->
        <div class="d-flex flex-column col-sm-1">

            @if ($task->status == $task::STATUS_TODO)

                <button
                    data-funct="start"
                    data-ajax-route="{{route('taskCard-setStarted', $task->id)}}"
                    type="button" class="btn btn-success btn-circle col-sm-1"
                    data-tooltip="tooltip" data-placement="bottom" title="Start task">
                    <i class="far fa-play-circle icon-white"></i>
                </button>
            @else

                <!-- BOTON DE VISUALIZAR -->
                <button
                    data-funct="view"
                    type="button" class="btn btn-info btn-circle btn-sm "
                    data-tooltip="tooltip" data-placement="bottom" title="View task"
                    data-toggle="collapse" data-target="#task-data-{{$task->id}}">
                    <i class="far fa-eye icon-white"></i>
                </button>

                @if ($task->status == $task::STATUS_DOING)

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
                        data-ajax-route="{{route('taskCard-setDone', $task->id)}}"
                        type="button" class="btn btn-success btn-circle btn-sm mt-2"
                        data-tooltip="tooltip" data-placement="bottom" title="Set done">
                        <i class="far fa-check-circle icon-white"></i>
                    </button>

                @elseif ($task->status == $task::STATUS_DONE)

                    <!-- BOTON DE ELIMINAR -->
                    <button
                        data-funct="delete"
                        data-ajax-route="{{route('taskCard-setDelete', $task->id)}}"
                        type="button"class="btn btn-danger btn-circle btn-sm mt-2"
                        data-tooltip="tooltip" data-placement="bottom" title="Remove task">
                        <i class="far fa-trash-alt icon-white"></i>
                    </button>

                @endif

            @endif

        </div>

    </div>

</div>

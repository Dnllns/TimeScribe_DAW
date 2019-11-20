
<!-- TITULO DE LA TAREA -->
<div data-taskid="{{$task->id}}" class="card border-fat shadow mb-2">


    {{-- CARD BODY --}}
    <div class="row m-2">


        <!-- CABECERA -->
        <div class="col-md-11 p-0 no-gutters">

            <!-- TITULO Y DESCRIPCION -->
            <div data-name="{{ $task->name }}" class="font-weight-bold text-primary text-uppercase mb-1">
                {{ $task->name }}
            </div>
            <div class="font-weight-bold mb-1">{{ $task->description }}</div>


            <!-- TASK DATA -->
            <div id="task-data-{{$task->id}}" class="row collapse text-xs">

                <div class="col-12 m-1"
                    data-tooltip="tooltip" data-placement="bottom" title="Worked time">
                    <i class="fas fa-business-time mr-1"></i>
                    {{ $task->getWorkedTime($task->id) }}
                </div>

                <div class="col-12 m-1"
                    data-tooltip="tooltip" data-placement="bottom" title="Start date">
                    <i class="fas fa-calendar-day mr-1"></i>
                    {{ $task->start_date }}
                </div>

                @if($task->status == $task::STATUS_DONE)
                    <div class="col-12 m-1"
                        data-tooltip="tooltip" data-placement="bottom" title="Finish date">
                        <i class="fas fa-calendar-check mr-1"></i>
                        {{ $task->finish_date }}
                    </div>
                @endif
            </div>

        </div>

        <!-- BOTONES -->
        <div class="col-md-1 p-0 d-flex flex-column align-items-center">

            @if ($task->status == $task::STATUS_TODO)
                @include('task.partials.task_item_buttons', ['type' => 'START'] )
            @else
                <!-- BOTON DE VISUALIZAR -->
                @include('task.partials.task_item_buttons', ['type' => 'VIEW'] )

                @if ($task->status == $task::STATUS_DOING)

                    <!-- BOTON DE SELECT -->
                    @include('task.partials.task_item_buttons', ['type' => 'SELECT'] )

                    <!-- BOTON DE COMPLETADO -->
                    @include('task.partials.task_item_buttons', ['type' => 'DONE'] )

                @elseif ($task->status == $task::STATUS_DONE)

                    <!-- BOTON DE ELIMINAR -->
                    @include('task.partials.task_item_buttons', ['type' => 'DELETE'] )

                @endif

            @endif

        </div>

    </div>

</div>

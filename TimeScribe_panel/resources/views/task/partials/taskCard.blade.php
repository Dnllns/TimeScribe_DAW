
<!-- TITULO DE LA TAREA -->
<div data-taskid="{{$task->id}}" class="item card border-fat shadow mb-4 item p-2">


    {{-- CARD BODY --}}
    <div class="d-flex flex-row">


        <!-- CABECERA -->
        <div class="col-sm-11 no-gutters align-items-center ">

            <!-- TITULO Y DESCRIPCION -->
            <div data-chronofunt="taskname" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                {{ $task->name }}
            </div>
            <div class="text-xs font-weight-bold mb-1">{{ $task->description }}</div>


            <!-- TASK DATA -->
            <div id="task-data-{{$task->id}}" class="col mr-2 pt-1 collapse text-xs">

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
        <div class="col-sm-1 d-flex flex-column align-items-center">

            @if ($task->status == $task::STATUS_TODO)
                @include('task.partials.cardButton', ['type' => 'START'] )
            @else
                <!-- BOTON DE VISUALIZAR -->
                @include('task.partials.cardButton', ['type' => 'VIEW'] )

                @if ($task->status == $task::STATUS_DOING)

                    <!-- BOTON DE SELECT -->
                    @include('task.partials.cardButton', ['type' => 'SELECT'] )

                    <!-- BOTON DE COMPLETADO -->
                    @include('task.partials.cardButton', ['type' => 'DONE'] )

                @elseif ($task->status == $task::STATUS_DONE)

                    <!-- BOTON DE ELIMINAR -->
                    @include('task.partials.cardButton', ['type' => 'DELETE'] )

                @endif

            @endif

        </div>

    </div>
    
</div>

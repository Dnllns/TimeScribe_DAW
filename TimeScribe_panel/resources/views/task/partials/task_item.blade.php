
<!-- TITULO DE LA TAREA -->
<div class="card mb-2">

        <!-- CABECERA -->
        {{-- ------------------------------- --}}

        <div data-name
        class="card-header col-12 p-2 text-uppercase">
            <!-- TITULO -->
            {{ $task->name }}

            <div class="float-right">
                <a data-togglebuttons data-toggle="collapse"
                href="div[data-togglebuttonscontainer]" role="button" >
                    <i class="fas fa-tools"></i>
                </a>
            </div>

        </div>

        <div data-togglebuttonscontainer class="col-12 float-right p-0 collapse">

            <div class="col-4 float-right">

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


        {{-- CONTENIDO --}}
        {{-- ----------------------------------------- --}}

        <div class="col-12 pt-2">

            {{-- DESCRIPCION --}}
            <div data-description class="">{{ $task->description }}</div>


            <!-- TASK DATA -->
            <div id="task-data-{{$task->id}}" class="row collapse text-xs">

                <div data-workedtime class="col-12 m-1"
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
        {{-- <div class="col-12 pt-2">

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

        </div> --}}


</div>

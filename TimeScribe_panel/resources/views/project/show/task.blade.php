
<!-- TITULO DE LA TAREA -->
<div class="card m-3">

    <!-- CABECERA -->
    {{-- ------------------------------- --}}

    @php
    $textStyle = "";

    switch ($task->status) {
        case $task::STATUS_TODO:
            $textStyle = "text-todo";
            break;

        case $task::STATUS_DOING:
            $textStyle = "text-doing";
            break;

        case $task::STATUS_DONE:
            $textStyle = "text-done";
            break;
    }
    @endphp

    <div data-name class="card-header col-12 py-1 px-2 text-uppercase bg-dark {{$textStyle}}">

        <!-- TITULO -->
        {{$task->name}}

        <div class="float-right">
            <a data-togglebuttons data-toggle="collapse" href="div[data-toggleid='{{$task->id}}']" role="button" >
                <i data-funct class="fas fa-tools"></i>
            </a>
        </div>

    </div>


    {{-- CONTENIDO --}}
    {{-- ----------------------------------------- --}}

    <div class="card-body col-12 p-2">

        {{-- BOTONES COLLAPSE --}}
        <div data-toggleid="{{$task->id}}" class="bg-dark rounded collapse">
            @if ($task->status == $task::STATUS_TODO)
                @include('project.show.task_buttons', ['type' => 'START'] )
            @else


                @if ($task->status == $task::STATUS_DOING)

                    <!-- BOTON DE SELECT -->
                    @include('project.show.task_buttons', ['type' => 'SELECT'] )

                    <!-- BOTON DE COMPLETADO -->
                    @include('project.show.task_buttons', ['type' => 'DONE'] )

                @elseif ($task->status == $task::STATUS_DONE)

                    <!-- BOTON DE ELIMINAR -->
                    @include('project.show.task_buttons', ['type' => 'DELETE'] )

                @endif

                <!-- BOTON DE VISUALIZAR -->
                @include('project.show.task_buttons', ['type' => 'VIEW'] )

            @endif
        </div>

        {{-- DESCRIPCION --}}
        <div  class="row p-0">
            <div class ="col-12"><strong>Description:</strong></div>
            <div data-description class="col-12">{{ $task->description }}</div>
        </div>


        <!-- TASK DATA -->
        <div id="task-data-{{$task->id}}" class="row p-0 collapse">

            {{-- Worked time --}}
            <div class ="col-12">
                <strong>Worked time:</strong>
            </div>
            <div data-workedtime class="col-12">{{$task->getWorkedTime()}}</div>

            {{-- Start date --}}
            <div class ="col-12">
                <strong>Start date:</strong>
            </div>
            <div data-startdate class="col-12">{{$task->start_date}}</div>

            @if($task->status == $task::STATUS_DONE)
            <div class ="col-12">
                <strong>Finish date:</strong>
            </div>
            <div data-finishdate class="col-12">{{$task->finish_date}}</div>
            @endif


        </div>

    </div>

</div>

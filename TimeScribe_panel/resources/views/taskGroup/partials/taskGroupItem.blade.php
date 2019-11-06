<div class="d-flex align-items-center" data-taskgroup-id="{{$taskGroup->id}}">


    <!-- NOMBRE DEL GRUPO -->
    <div class="col-sm-2">
        <p class="small font-weight-bold m-0" data-toggle="tooltip" data-placement="top" title="Task group name">{{$taskGroup->name}}</p>
    </div>

    <!-- BARRA DE PROGRESO -->
    <div class="row col-sm-6 mr-2 ">
        <div class="progress col ">
            <div class="progress-bar progress-bar-striped progress-bar-animated

            @if ($taskGroup->getPercentCompleted() < 20 )
                bg-danger
            @elseif ($taskGroup->getPercentCompleted() >= 20 && $taskGroup->getPercentCompleted() < 40)
                bg-warning
            @elseif ($taskGroup->getPercentCompleted() >= 40 && $taskGroup->getPercentCompleted() < 60)
                bg-primary
            @elseif ($taskGroup->getPercentCompleted() >= 60 && $taskGroup->getPercentCompleted() < 80)
                bg-info
            @elseif ($taskGroup->getPercentCompleted() >= 80 && $taskGroup->getPercentCompleted() == 100)
                bg-success
            @endif

            " role="progressbar"
            style="width: {{$taskGroup->getPercentCompleted()}}%"
            aria-valuenow="{{$taskGroup->getPercentCompleted()}}"
            aria-valuemin="0" aria-valuemax="100" ></div>
        </div>
        <div class="small font-weight-bold col-sm-2 ">{{$taskGroup->getPercentCompleted()}}%</div>
    </div>

    <!-- ICONOS DE TODO DOING DONE -->
    <div class="col-sm-2" >
        <span
            class="btn btn-circle btn-sm bg-warning mb-1"
            data-tooltip="tooltip" data-placement="bottom" title="To do">
            <strong class="text-dark">{{count($taskGroup->getTasks(0))}}</strong>
        </span>

        <span
            class="btn btn-circle btn-sm bg-info mb-1 "
            data-tooltip="tooltip" data-placement="bottom" title="Doing">
            <strong class="text-dark">{{count($taskGroup->getTasks(1))}}</strong>


        </span>

        <span
            class="btn btn-circle btn-sm bg-success mb-1 "
            data-tooltip="tooltip" data-placement="bottom" title="Done">
            <strong class="text-dark">{{count($taskGroup->getTasks(2))}}</strong>


        </span>

    </div>

    <!-- BOTON DE COLLAPSE -->
    <div class="col-sm-2">

        <button class="btn btn-sm bg-primary mb-1" data-toggle="collapse" data-target="#task-list" >
            <i class="fas fa-chevron-down icon-white"></i>
        </button>

    </div>


</div>

{{-- TAREAS DEL GRUPO --}}
<div id="task-list" class="row mt-3 collapse">

    {{-- TODO --}}
    <div class="col-sm-4 d-flex justify-content-center">
        TO DO
    </div>
    {{-- DOING --}}
    <div class="col-sm-4 d-flex justify-content-center">
        DOING
    </div>
    {{-- DONE --}}
    <div class="col-sm-4 d-flex justify-content-center">
        DONE
    </div>

    @foreach ($tasks as $task)

        <div class="col-sm-10 p-10">
            @include('task.partials.taskCard' )
        </div>

    @endforeach
</div>

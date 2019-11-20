<div class="row" data-taskgroup-id="{{$taskGroup->id}}">


    <!-- NOMBRE DEL GRUPO -->
    <div class="col-12 mb-1 text-center col-md-4 my-md-auto text-md-left">
        <p class="font-weight-bold m-0 text-uppercase" data-tooltip="tooltip" data-placement="top" title="Task group name">{{$taskGroup->name}}</p>
    </div>

    <!-- BARRA DE PROGRESO -->
    <div class="col-6 col-md-4 my-auto">

        <div class="row mx-auto">
            {{-- BARRA --}}
            <div class="col-9 p-0">
                 <div class="progress">
                    <div class=" progress-bar progress-bar-striped progress-bar-animated

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
            </div>

            {{-- PORCENTAJE --}}
            <div class="small font-weight-bold col-3 pr-0">{{$taskGroup->getPercentCompleted()}}%</div>

        </div>

    </div>

    <!-- ICONOS DE TODO DOING DONE -->
    <div class="col-4 col-md-3 my-auto text-center" >
        <span
            class="btn btn-circle icon-sm bg-warning mb-1"
            data-tooltip="tooltip" data-placement="bottom" title="To do">
            <strong class="text-dark">{{count($taskGroup->getTasks(0))}}</strong>
        </span>

        <span
            class="btn btn-circle icon-sm bg-info mb-1 "
            data-tooltip="tooltip" data-placement="bottom" title="Doing">
            <strong class="text-dark">{{count($taskGroup->getTasks(1))}}</strong>
        </span>

        <span
            class="btn btn-circle icon-sm bg-success mb-1 "
            data-tooltip="tooltip" data-placement="bottom" title="Done">
            <strong class="text-dark">{{count($taskGroup->getTasks(2))}}</strong>
        </span>

    </div>

    <!-- BOTON DE COLLAPSE -->
    <div class="col-1 my-auto text-center">

        <button class="btn bg-primary " data-toggle="collapse" data-target="#task-list-{{$taskGroup->id}}" >
            <i class="fas fa-chevron-down icon-white"></i>
        </button>

    </div>


    {{-- TAREAS DEL GRUPO --}}
    <div id="task-list-{{$taskGroup->id}}" class="col-sm-12 mt-3 collapse">

        <div class="row">

            {{-- TODO --}}
            <div class="col-sm-4 border-right border-fat">
                <p class="text-center">TO DO</p>
                @foreach ($taskGroup->getTasks(0) as $task)
                    <div class="col-sm-12 mx-auto">
                        @include('task.partials.task_item', ['task' => $task] )
                    </div>
                @endforeach
            </div>

            {{-- DOING --}}
            <div class="col-sm-4 border-right border-fat">
                <p class="text-center">DOING</p>
                @foreach ($taskGroup->getTasks(1) as $task)
                    <div class="col-sm-12 mx-auto">
                        @include('task.partials.task_item', ['task' => $task] )
                    </div>
                @endforeach
            </div>

            {{-- DONE --}}
            <div class="col-sm-4 border-fat">
                <p class="text-center">DONE</p>
                @foreach ($taskGroup->getTasks(2) as $task)
                    <div class="col-sm-12 mx-auto">
                        @include('task.partials.task_item', ['task' => $task] )
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</div>

<hr>




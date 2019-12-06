<div class="row" data-taskgroup-id="{{$taskGroup->id}}">


    {{-- ----------------------------------------------------------------- --}}
    {{-- PARTE VISIBLE --}}



        <!-- NOMBRE DEL GRUPO -->
        <div class="col-12 pb-2 text-center col-md-12 my-md-auto col-lg-4 text-lg-left">
            <h3 data-taskgroup-name
            class="font-weight-bold m-0 text-uppercase"
            data-tooltip="tooltip" data-placement="top" title="Task group name">
                {{$taskGroup->name}}
            </h3>
        </div>

        <!-- BARRA DE PROGRESO -->
        <div class="col-12 pb-2 my-auto col-md-6 pb-md-0 col-lg-4 my-lg-auto ">


            <div class="progress col-12 p-0" style="height:20px;">

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
                aria-valuemin="0" aria-valuemax="100" >
                </div>
                {{$taskGroup->getPercentCompleted()}}%
            </div>

        </div>



        <!-- ICONOS DE TODO DOING DONE -->
        <div class="col-12 my-auto pt-2 text-center col-md-6 pt-md-0 col-lg-4" >

            @if ($taskGroup['visible'] == 0)

            <span
                class="btn btn-circle icon-sm mb-1 bg-secondary "
                data-tooltip="tooltip" data-placement="bottom" title="Not visible">
                <i class="fas fa-eye-slash text-white"></i>
            </span>
            &nbsp;

            @endif

            <span
                class="btn btn-circle icon-sm mb-1 bg-secondary"
                data-tooltip="tooltip" data-placement="bottom" title="To do">
                <strong class="text-todo">{{count($taskGroup->getTasks(0))}}</strong>
            </span>

            <span
                class="btn btn-circle icon-sm mb-1 bg-secondary"
                data-tooltip="tooltip" data-placement="bottom" title="Doing">
                <strong class="text-doing">{{count($taskGroup->getTasks(1))}}</strong>
            </span>

            <span
                class="btn btn-circle icon-sm mb-1 bg-secondary"
                data-tooltip="tooltip" data-placement="bottom" title="Done">
                <strong class="text-done">{{count($taskGroup->getTasks(2))}}</strong>
            </span>

            &nbsp;

            <a href="{{route('v-tg-mod', ['taskgroupId' => $taskGroup->id])}}" class="btn btn-circle btn-sm bg-dark mb-1" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                <i class="far fa-edit icon-white"></i>
            </a>

            <a href data-del data-ajax="{{route('f-tg-del', ['taskgroupId' => $taskGroup->id])}}" class="btn btn-circle btn-sm bg-dark mb-1" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Delete">
                <i class="far fa-trash-alt icon-white"></i>
            </a>

            <button class="btn btn-circle btn-sm bg-dark mb-1" data-toggle="collapse" data-target="#task-list-{{$taskGroup->id}}" >
                <i class="far fa-eye icon-white"></i>
            </button>


        </div>


    {{-- FIN PARTE VISIBLE --}}
    {{-- ---------------------------------------------------------------------------- --}}

    {{-- TAREAS DEL GRUPO --}}
    <div id="task-list-{{$taskGroup->id}}" class="col-sm-12 mt-1 collapse">
        <hr>

        <div class="row">

            {{-- TODO --}}
            <div data-todo class="col-12 m-0 mb-1 col-lg-4">

                <div class="row m-0 p-1 rounded bg-todo">

                    <div class="col-10  my-auto col-lg-12" >
                        <h4 class="text-left text-dark m-0 p-0 text-lg-center ">
                            TO DO
                        </h4>
                    </div>

                    <div class="col-2 text-right d-lg-none">

                        <button class="m-0 p-0 btn btn-circle btn-sm bg-dark" data-toggle="collapse" data-target="#todo-{{$taskGroup->id}}" >
                            <i class="far fa-eye icon-white"></i>
                        </button>

                    </div>

                </div>

                <div class="row mt-2 p-1">
                    <div id="todo-{{$taskGroup->id}}" data-collapse="js" class="col-12">
                        <ul class="p-0" style="list-style: none">
                            @foreach ($taskGroup->getTasks(0) as $task)
                            <li data-taskid="{{$task->id}}">
                                    @include('task.partials.task_item', ['task' => $task] )
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            {{-- DOING --}}
            <div data-doing class="col-12 m-0 mb-1 col-lg-4">

                <div class="row m-0 p-1 rounded bg-doing">

                    <div class="col-10 my-auto col-lg-12" >
                        <h4 class="text-left text-dark m-0 p-0 text-lg-center ">
                            DOING
                        </h4>
                    </div>


                    {{-- BOTON COLLAPSE  --}}
                    <div class="col-2 text-right d-lg-none">
                        <button class="m-0 p-0 btn btn-circle btn-sm bg-dark" data-toggle="collapse" data-target="#doing-{{$taskGroup->id}}" >
                            <i class="far fa-eye icon-white"></i>
                        </button>
                    </div>

                </div>

                {{-- CONTENEDOR DE TAREAS --}}
                <div class="row mt-2 p-1" >
                    <div id="doing-{{$taskGroup->id}}" data-collapse="js" class="col-12">
                        <ul class="p-0" style="list-style: none">
                            @foreach ($taskGroup->getTasks(1) as $task)
                            <li data-taskid="{{$task->id}}">
                                @include('task.partials.task_item', ['task' => $task] )
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>


            {{-- DONE --}}

            <div data-done class="col-12 m-0 mb-1 col-lg-4">

                <div class="row m-0 p-1 rounded bg-done">

                    <div class="col-10 my-auto col-lg-12" >
                        <h4 class="text-left text-dark m-0 p-0 text-lg-center ">
                            DONE
                        </h4>
                    </div>

                    <div class="col-2 text-right d-lg-none">

                        <button class="m-0 p-0 btn btn-circle btn-sm bg-dark"
                            data-toggle="collapse" data-target="#done-{{$taskGroup->id}}" aria-expanded="false">
                            <i class="far fa-eye icon-white"></i>
                        </button>

                    </div>

                </div>

                <div class="row mt-2 p-1">
                    <div id="done-{{$taskGroup->id}}" data-collapse="js" class="col-12">
                        <ul class="p-0" style="list-style: none">
                            @foreach ($taskGroup->getTasks(2) as $task)
                            <li data-taskid="{{$task->id}}">
                                @include('task.partials.task_item', ['task' => $task] )
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>





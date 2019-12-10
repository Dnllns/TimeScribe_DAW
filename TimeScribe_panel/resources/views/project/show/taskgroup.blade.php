<div class="row" data-taskgroup-id="{{$taskGroup->id}}">


    {{-- ----------------------------------------------------------------- --}}
    {{-- PARTE VISIBLE --}}

    <!-- NOMBRE DEL GRUPO -->
    <div class="col-12 pb-2 text-center col-lg-4 my-lg-auto pb-lg-0 text-lg-left ">
        <h3 data-taskgroup-name
        class="font-weight-bold m-0 text-uppercase"
        data-tooltip="tooltip" data-placement="top" title="Task group name">
            {{$taskGroup->name}}
        </h3>
    </div>

    <!-- BARRA DE PROGRESO -->
    <div class="col-12 pb-2 my-auto col-md-6 pb-md-0 col-lg-4 my-lg-auto">
        <div class="progress col-12 p-0 " style="height:20px;">

            @php
            $bg= "";
            $percent=$taskGroup->getPercentCompleted();
            if ($percent < 20 ) {$bg="bg-danger";}
            elseif ($percent >= 20 && $percent < 40){$bg="bg-warning";}
            elseif ($percent >= 40 && $percent < 60){$bg="bg-primary";}
            elseif ($percent >= 60 && $percent < 80){$bg="bg-info";}
            elseif ($percent >= 80 && $percent == 100){$bg="bg-success";}
            @endphp

            <div class="progress-bar {{$bg}}" role="progressbar"
                style="width: {{$percent}}%"
                aria-valuenow="{{$percent}}"
                aria-valuemin="0" aria-valuemax="100" >
                {{$percent}}%
            </div>


        </div>
    </div>



    <div class="col-12 text-center col-md-6 text-md-right col-lg-4 ">

        @if ($taskGroup['visible'] == 0)

        <span
            class="btn btn-circle icon-sm bg-secondary "
            data-tooltip="tooltip" data-placement="bottom" title="Not visible">
            <i class="fas fa-eye-slash text-white"></i>
        </span>

        &nbsp;

        @endif

        <span
            data-counttodo
            class="btn btn-circle icon-sm bg-secondary"
            data-tooltip="tooltip" data-placement="bottom" title="To do">
            <strong class="text-todo">{{count($taskGroup->getTasks(0))}}</strong>
        </span>

        <span
            data-countdoing
            class="btn btn-circle icon-sm bg-secondary"
            data-tooltip="tooltip" data-placement="bottom" title="Doing">
            <strong class="text-doing">{{count($taskGroup->getTasks(1))}}</strong>
        </span>

        <span
            data-countdone
            class="btn btn-circle icon-sm bg-secondary"
            data-tooltip="tooltip" data-placement="bottom" title="Done">
            <strong class="text-done">{{count($taskGroup->getTasks(2))}}</strong>
        </span>

        &nbsp;

        <a href="{{route('v-tg-mod', ['taskgroupId' => $taskGroup->id])}}" class="btn btn-circle btn-sm bg-dark" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Edit">
            <i class="far fa-edit icon-white"></i>
        </a>

        <a href data-del data-ajax="{{route('f-tg-del', ['taskgroupId' => $taskGroup->id])}}" class="btn btn-circle btn-sm bg-dark" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Delete">
            <i class="far fa-trash-alt icon-white"></i>
        </a>


        <a class="btn btn-sm" data-toggle="collapse" data-target="#task-list-{{$taskGroup->id}}" >
            <i class="fas fa-chevron-down"></i>
        </a>

    </div>



    {{-- FIN PARTE VISIBLE --}}
    {{-- ---------------------------------------------------------------------------- --}}

    {{-- TAREAS DEL GRUPO --}}
    <div id="task-list-{{$taskGroup->id}}" class="col-sm-12 mt-1 collapse">

        <hr>

        <div class="row">

            {{-- TODO --}}
            @include('project.show.status_column', ['status' => 'todo', 'statusId' => 0])

            {{-- DOING --}}
            @include('project.show.status_column', ['status' => 'doing', 'statusId' => 1])


            {{-- DONE --}}
            @include('project.show.status_column', ['status' => 'done', 'statusId' => 2])

        </div>

    </div>

</div>





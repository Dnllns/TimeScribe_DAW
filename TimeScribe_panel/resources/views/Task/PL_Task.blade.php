
<!-- TITULO DE LA TAREA -->
<div id="task_{{$task->id}}" class="item card border-fat shadow mb-4 item py-2">

    <div class="card-body d-flex flex-row">

        
        <!-- CABECERA -->
        <div class="col-sm-11 no-gutters align-items-center ">

            <!-- TITULO Y DESCRIPCION -->
            <div id="t_name_{{$task->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $task->name }}</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $task->description }}</div>


            <!-- TASK DATA -->
            <div id="taskcontent_{{$task->id}}" class="col mr-2 pt-4 collapse">

                @yield('task_data')

            </div>

        </div>

        <!-- BOTONES -->
        <div class="d-flex flex-column col-sm-1">

            @yield('task_buttons')

        </div>

    </div>

</div>







<!-- STICKY CHRONO -->
<div 
    id="sticky-chrono" data-taskid=""
    class="sticky-chrono col-sm-12 row justify-content-center d-none">

    {{-- NOMBRE DE LA TAREA ACTUAL --}}
    <div class="m-2 align-self-center">
        <p id="task_name" class="font-weight-bold"></p>
    </div>


    <!-- CHRONO -->
    <div class="m-2 d-flex flex-column justify-content-center chrono-container"  data-taskid="NONE">
        <p id="task_name" class="styckychrono-title-font"></p>
        <p id="chronotime" class="m-0 chrono-font font-weight-bold">00:00:00</p>
        <!-- BOTONES -->
        <div class="">

            <!-- START -->
            <!-- Ruta con parametro id vacio -->

            <button 
                id="chrono-start"
                type="button"  class="btn btn-sm btn-primary m-1" 
                data-start-route="{{route('chrono-start', '')}}">
                <i class="fas fa-play icon-white"></i>
            </button>

            {{-- STOP --}}
            <button 
                id="chrono-stop"
                type="button"  class="btn btn-sm btn-primary m-1 d-none" 
                data-stop-route="{{route('chrono-stop')}}">
                <i class="fas fa-pause icon-white"></i>
            </button>

            {{-- RESUME --}}
            <button 
                id="chrono-resume"
                type="button"  class="btn btn-sm btn-warning m-1 d-none"> 
                <i class="fas fa-play icon-white"></i>
            </button>

            <!-- RESET -->
            <!-- Ruta con parametro id vacio -->
            <button 
                id="chrono-reset"
                data-reset-route="{{route('chrono-reset','')}}"  
                type="button"  class="btn btn-sm btn-danger m-1 d-none">
                <i class="fas fa-undo icon-white"></i>
            </button>

            <!-- GUARDAR CAMBIOS -->
            <!-- Ruta con parametro id vacio -->
            <button 
                id="chrono-finish" 
                data-finish-route="{{route('chrono-finish','')}}"
                type="button" class="btn btn-sm btn-info m-1 d-none">
                <i class="fas fa-save icon-white"></i>
            </button>
        </div>
    </div>
  

</div>

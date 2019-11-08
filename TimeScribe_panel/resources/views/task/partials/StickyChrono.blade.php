
<!-- STICKY CHRONO -->
<div id="sticky-chrono" data-current-taskid="" class="row col-sm-12 d-none sticky">


    <!-- CHRONO -->
    <div class="column chrono-container mx-auto my-2">
        {{-- NOMBRE DE LA TAREA ACTUAL --}}
        <p id="task_name" class="m-0 text-center styckychrono-title-font "></p>
        <p id="chronotime" class="m-0 text-center chrono-font font-weight-bold">00:00:00</p>
        <!-- BOTONES -->
        <div class="text-center">

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

            <button 
                id="chrono-close"
                type="button"  class="btn btn-sm btn-dark m-1">
                <i class="fas fa-times icon-white"></i>
            </button>
        </div>
    </div>
  
</div>


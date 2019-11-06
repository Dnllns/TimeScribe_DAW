
<!-- STICKY CHRONO -->
<div 
    id="sticky-chrono" data-taskid=""
    class="sticky-chrono row d-none justify-content-center">


    <!-- <div class="m-2 align-self-center">
        <p id="task_name" class="font-weight-bold"></p>
    </div> -->


    <!-- CHRONO -->
    <div class="m-2 d-flex flex-column justify-content-center"  data-taskid="NONE">
        <p id="task_name" class="styckychrono-title-font"></p>
        <p id="chronotime" class="chrono font-weight-bold">00:00:00</p>
        <!-- BOTONES -->
        <div class="">

            <!-- START/STOP/RESUME -->
            <!-- Ruta con parametro id vacio -->

            <button 
                id="chrono-start"
                type="button"  class="btn btn-primary btn-icon-split" 
                data-chronofunct="start"
                data-start-route="{{route('chrono-start', '')}}"
                data-stop-route="{{route('chrono-stop')}}">
                <span class="icon text-white-50"><i class="far fa-clock icon-white"></i></span>
                <span class="text">Start counting time</span>
            </button>

            <!-- RESET -->
            <!-- Ruta con parametro id vacio -->
            <button 
                id="chrono-reset"
                data-reset-route="{{route('chrono-reset','')}}"  
                type="button"  class="ml-2 btn btn-danger btn-icon-split d-none">
                <span class="icon text-white-50"><i class="fas fa-undo icon-white"></i></span>
                <span class="text">Reset time</span>
            </button>
        </div>
    </div>


    <!-- GUARDAR CAMBIOS -->
    <!-- Ruta con parametro id vacio -->
    <button 
        id="chrono-finish" 
        data-finish-route="{{route('chrono-finish','')}}"
        class="btn" type="button">
        Save
    </button>


    

</div>

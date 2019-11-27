
<!-- STICKY CHRONO -->
<div id="sticky-chrono" data-current-taskid="" class="row d-none">

    <div class="card text-white bg-dark col-12 p-0 mb-3">

        {{-- Nombre del grupo de tarea --}}
        <div class="card-header" style="background: #00000054;">
            <div id="ch-taskgroup-name"></div>
        </div>

        <div class="card-body">
            
            <div class="row">

                {{-- Nombre de la tarea --}}
                <div class="col my-auto">            
                    <h5 id="ch-task-name" class="card-title m-0"></h5>
                </div>

                <div class="col my-auto">
                    
                    {{-- Cronometro --}}
                    <div class="float-left my-auto">
                        <div id="chronotime" style="font-size: x-large;">00:00:00</div>
                    </div>

                    {{-- Botones --}}
                    <div class="float-right">

                        {{-- START --}}
                        <button
                            id="chrono-start"
                            type="button"  class="btn btn-sm btn-primary m-1"
                            data-ajax="{{route('f-ts-ch-start', '')}}">
                            <i class="fas fa-play icon-white"></i>
                        </button>

                        {{-- STOP --}}
                        <button
                            id="chrono-stop"
                            type="button"  class="btn btn-sm btn-primary m-1 d-none"
                            data-ajax="{{route('f-ts-ch-stop')}}">
                            <i class="fas fa-pause icon-white"></i>
                        </button>

                        {{-- RESUME --}}
                        <button
                            id="chrono-resume"
                            type="button"  class="btn btn-sm btn-warning m-1 d-none"
                            data-ajax="{{route('f-ts-ch-start', '')}}">
                            <i class="fas fa-play icon-white"></i>
                        </button>

                        <!-- RESET -->
                        <!-- Ruta con parametro id vacio -->
                        <button
                            id="chrono-reset"
                            data-ajax="{{route('f-ts-ch-reset','')}}"
                            type="button"  class="btn btn-sm btn-danger m-1 d-none">
                            <i class="fas fa-undo icon-white"></i>
                        </button>

                        <!-- FINISH/SAVE -->
                        <!-- Ruta con parametro id vacio -->
                        <button
                            id="chrono-finish"
                            data-ajax="{{route('f-ts-ch-finish','')}}"
                            type="button" class="btn btn-sm btn-info m-1 d-none">
                            <i class="fas fa-save icon-white"></i>
                        </button>

                        {{-- CLOSE --}}
                        <button
                            id="chrono-close"
                            type="button"  class="btn btn-sm btn-danger m-1">
                            <i class="fas fa-times icon-white"></i>
                        </button>



                    
                    </div>
                
                </div>

            </div>

        </div>
    </div>


</div>


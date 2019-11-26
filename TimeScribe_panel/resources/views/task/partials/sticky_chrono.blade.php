
<!-- STICKY CHRONO -->
<div id="sticky-chrono" data-current-taskid="" class="col-12 d-none sticky">


    <div class="row">


        {{-- NOMBRE TAREA --}}
        <div class="col-6 my-auto">
            <div id="task_name" class="styckychrono-title-font "></div>
        </div>

        {{-- Cronometro y Botones --}}
        <div class="col-6">

            <div class="row">

                {{-- Cronometro --}}
                <div class="col-8 my-auto">
                    <div id="chronotime" class="chrono-font font-weight-bold">00:00:00</div>
                </div>

                {{-- Botones --}}
                <div class="col-4 my-auto">
                    <div class="float-right">

                        <button
                            id="chrono-start"
                            type="button"  class="btn btn-sm btn-primary m-1"
                            data-start-route="{{route('f-ts-ch-start', '')}}">
                            <i class="fas fa-play icon-white"></i>
                        </button>

                        {{-- STOP --}}
                        <button
                            id="chrono-stop"
                            type="button"  class="btn btn-sm btn-primary m-1 d-none"
                            data-stop-route="{{route('f-ts-ch-stop')}}">
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
                            data-reset-route="{{route('f-ts-ch-reset','')}}"
                            type="button"  class="btn btn-sm btn-danger m-1 d-none">
                            <i class="fas fa-undo icon-white"></i>
                        </button>

                        <!-- GUARDAR CAMBIOS -->
                        <!-- Ruta con parametro id vacio -->
                        <button
                            id="chrono-finish"
                            data-finish-route="{{route('f-ts-ch-finish','')}}"
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


        </div>


    </div>


    <!-- CHRONO -->
    {{-- <div class="column chrono-container mx-auto my-2"> --}}
        {{-- NOMBRE DE LA TAREA ACTUAL --}}
        {{-- <p id="task_name" class="m-0 text-center styckychrono-title-font "></p>
        <p id="chronotime" class="m-0 text-center chrono-font font-weight-bold">00:00:00</p> --}}
        <!-- BOTONES -->
        {{-- <div class="text-center"> --}}

            <!-- START -->
            <!-- Ruta con parametro id vacio -->

            {{-- <button
                id="chrono-start"
                type="button"  class="btn btn-sm btn-primary m-1"
                data-start-route="{{route('f-ts-ch-start', '')}}">
                <i class="fas fa-play icon-white"></i>
            </button> --}}

            {{-- STOP --}}
            {{-- <button
                id="chrono-stop"
                type="button"  class="btn btn-sm btn-primary m-1 d-none"
                data-stop-route="{{route('f-ts-ch-stop')}}">
                <i class="fas fa-pause icon-white"></i>
            </button> --}}

            {{-- RESUME --}}
            {{-- <button
                id="chrono-resume"
                type="button"  class="btn btn-sm btn-warning m-1 d-none">
                <i class="fas fa-play icon-white"></i>
            </button> --}}

            <!-- RESET -->
            <!-- Ruta con parametro id vacio -->
            {{-- <button
                id="chrono-reset"
                data-reset-route="{{route('f-ts-ch-reset','')}}"
                type="button"  class="btn btn-sm btn-danger m-1 d-none">
                <i class="fas fa-undo icon-white"></i>
            </button> --}}

            <!-- GUARDAR CAMBIOS -->
            <!-- Ruta con parametro id vacio -->
            {{-- <button
                id="chrono-finish"
                data-finish-route="{{route('f-ts-ch-finish','')}}"
                type="button" class="btn btn-sm btn-info m-1 d-none">
                <i class="fas fa-save icon-white"></i>
            </button>

            <button
                id="chrono-close"
                type="button"  class="btn btn-sm btn-dark m-1">
                <i class="fas fa-times icon-white"></i>
            </button>
        </div>
    </div> --}}

</div>


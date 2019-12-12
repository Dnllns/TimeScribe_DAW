
<!-- STICKY CHRONO -->
<div id="sticky-chrono" data-current-taskid="" class="d-none col-11 col-sm-8 col-md-6 col-lg-3 p-0 mb-3">

    <div class="card">

        {{-- Nombre del grupo de tarea --}}
        <div class="card-header p-2 text-uppercase">
            <div id="ch-task-name"></div>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="mx-auto">
                    {{-- Cronometro --}}
                    <div id="chrono-container" class="col-12 mx-auto my-auto text-center border-dark  rounded">
                        <div id="chronotime" >00:00:00</div>
                    </div>

                    {{-- Botones --}}
                    <div class="col-12 pt-2 mx-auto my-auto text-center">

                        {{-- START --}}
                        <button
                            id="chrono-start"
                            type="button"  class="btn btn-circle btn-sm bg-dark d-none"
                            data-ajax="{{route('f-ts-ch-start', '')}}">
                            <i class="fas fa-play icon-white"></i>
                        </button>

                        {{-- STOP --}}
                        <button
                            id="chrono-stop"
                            type="button"  class="btn btn-circle btn-sm bg-dark d-none"
                            data-ajax="{{route('f-ts-ch-stop')}}">
                            <i class="fas fa-pause icon-white"></i>
                        </button>

                        {{-- RESUME --}}
                        <button
                            id="chrono-resume"
                            type="button"  class="btn btn-circle btn-sm bg-dark d-none"
                            data-ajax="{{route('f-ts-ch-start', '')}}">
                            <i class="fas fa-play icon-white"></i>
                        </button>

                        <!-- RESET -->
                        <!-- Ruta con parametro id vacio -->
                        <button
                            id="chrono-reset"
                            data-ajax="{{route('f-ts-ch-reset','')}}"
                            type="button"  class="btn btn-circle btn-sm bg-dark d-none">
                            <i class="fas fa-undo icon-white"></i>
                        </button>

                        <!-- FINISH/SAVE -->
                        <!-- Ruta con parametro id vacio -->
                        <button
                            id="chrono-finish"
                            data-ajax="{{route('f-ts-ch-finish','')}}"
                            type="button" class="btn btn-circle btn-sm bg-dark d-none">
                            <i class="fas fa-save icon-white"></i>
                        </button>

                        {{-- CLOSE --}}
                        <button
                            id="chrono-close"
                            type="button"  class="btn btn-circle btn-sm bg-dark d-none">
                            <i class="fas fa-times icon-white"></i>
                        </button>




                    </div>

                </div>

            </div>

        </div>
    </div>


</div>


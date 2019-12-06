<div class="row">



        <!-- NOMBRE DEL GRUPO -->
        <div class="col-12 pb-1 text-center my-auto col-md-7 p-md-0 pl-md-2 text-md-left">
            {{$taskGroup->name}}
        </div>


        <div class="col-12 text-center mx-auto my-auto col-md-5 text-md-right">


                {{-- ICONOS DE ESTADO --}}
                <span class="btn btn-circle btn-sm bg-secondary">
                        {{$taskGroup->getStatusIcon()}}
                </span>
                <span class="btn btn-circle btn-sm bg-secondary">
                    {{$taskGroup->getVisibilityIcon()}}
                </span>

                &nbsp;


                {{-- BOTONES DE EDITAR Y ELIMINAR --}}
                <a class="btn btn-circle btn-sm bg-dark text-white"
                    href="{{route('v-tg-mod', [$taskGroup->id])}}">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="btn btn-circle btn-sm bg-dark text-white"
                    href data-del data-funct="{{route('f-tg-del', [$taskGroup->id])}}">
                    <i class="fas fa-trash-alt"></i>
                </a>




        </div>



</div>




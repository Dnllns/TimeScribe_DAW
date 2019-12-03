<div class="row">



        <!-- NOMBRE DEL GRUPO -->
        <div class="col-6 col-md-8">
            {{$taskGroup->name}}
        </div>


        <div class="col-6 col-md-4">

            <div class="float-right">

                {{-- BOTONES DE EDITAR Y ELIMINAR --}}
                <a class="text-warning" href="{{route('v-tg-mod', [$taskGroup->id])}}">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="text-warning" href data-del data-funct="{{route('f-tg-del', [$taskGroup->id])}}">
                    <i class="fas fa-trash-alt"></i>
                </a>

                {{-- ICONOS DE ESTADO --}}
                {{$taskGroup->getStatusIcon()}}
                {{$taskGroup->getVisibilityIcon()}}

            </div>



        </div>



</div>




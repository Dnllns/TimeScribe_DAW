<div class="row" data-project-id="{{$project->id}}">


    <!-- NOMBRE DEL PROYECTO -->
    <div class="col-12 my-auto text-center col-lg-4 text-lg-left">
        <p class="text-uppercase m-0" data-toggle="tooltip" data-placement="top" title="Project name">
            <strong>{{$project->name}}</strong>
        </p>
    </div>

    {{-- CLIENTE --}}
    <div class="col-12 my-auto pb-2 text-center col-md-6 p-md-0 col-lg-2 text-lg-left">
        <p class="m-0">
            <i class="fas fa-user" data-toggle="tooltip" data-placement="top" title="Client"></i>

            @php
                $clientName="not set";
                $client = $project->getClient();
                if($client!=null){
                    $clientName=$project->getClient()->name;
                }
            @endphp
            {{$clientName}}
        </p>
    </div>

    <!-- BARRA DE PROGRESO -->
    <div class="col-12 pb-2 my-auto col-md-6 pb-md-0 col-lg-4 my-lg-auto">
        <div class="progress col-10 mx-auto p-0 " style="height:20px;">

            @php
            $bg= "";
            if ($project->getPercentCompleted() < 20 ) {$bg="bg-danger";}
            elseif ($project->getPercentCompleted() >= 20 && $project->getPercentCompleted() < 40){$bg="bg-wasrning";}
            elseif ($project->getPercentCompleted() >= 40 && $project->getPercentCompleted() < 60){$bg="bg-primary";}
            elseif ($project->getPercentCompleted() >= 60 && $project->getPercentCompleted() < 80){$bg="bg-info";}
            elseif ($project->getPercentCompleted() >= 80 && $project->getPercentCompleted() == 100){$bg="bg-success";}
            @endphp

            <div class="progress-bar {{$bg}}" role="progressbar"
                style="width: {{$project->getPercentCompleted()}}%"
                aria-valuenow="{{$project->getPercentCompleted()}}"
                aria-valuemin="0" aria-valuemax="100" >
                {{$project->getPercentCompleted()}}%
            </div>


        </div>
    </div>

    <!-- NOMBRE CLIENTE -->



    <!-- BOTONES -->
    <div class="col-12 my-auto pt-2 text-center pt-lg-0 col-lg-2 text-lg-right" >
        <a
            href="{{route('v-pj-show', $project->id)}}"
            class="btn btn-circle btn-sm bg-dark"
            data-tooltip="tooltip" data-placement="bottom" title="View">
            <i class="far fa-eye icon-white"></i>
        </a>

        @if ( $userPermissions == $project::PERM_ALL)

            <a
                href="{{route('v-pj-mod', $project->id)}}"
                class="btn btn-circle btn-sm bg-dark"
                data-tooltip="tooltip" data-placement="bottom" title="Edit">
                <i class="far fa-edit icon-white"></i>
            </a>

            <a
                href="{{route('f-pj-del', $project->id)}}"
                class="btn btn-circle btn-sm bg-dark"
                data-tooltip="tooltip" data-placement="bottom" title="Delete">
                <i class="far fa-trash-alt icon-white"></i>
            </a>

        @endif


    </div>

</div>

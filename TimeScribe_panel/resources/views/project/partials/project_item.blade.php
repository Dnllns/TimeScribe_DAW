<div class="row" data-project-id="{{$project->id}}">


    <!-- NOMBRE DEL PROYECTO -->
    <div class="col-6 p-2 col-md-4">
        <p class="text-uppercase m-0" data-toggle="tooltip" data-placement="top" title="Project name">
            <strong>{{$project->name}}</strong>
        </p>
    </div>

    <div class="col p-2 col-md-2">
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
    <div class="col-12 p-2 col-md-4">
        <div class="progress col ">
            <div class="progress-bar progress-bar-striped progress-bar-animated

            @if ($project->getPercentCompleted() < 20 )
                bg-danger
            @elseif ($project->getPercentCompleted() >= 20 && $project->getPercentCompleted() < 40)
                bg-warning
            @elseif ($project->getPercentCompleted() >= 40 && $project->getPercentCompleted() < 60)
                bg-primary
            @elseif ($project->getPercentCompleted() >= 60 && $project->getPercentCompleted() < 80)
                bg-info
            @elseif ($project->getPercentCompleted() >= 80 && $project->getPercentCompleted() == 100)
                bg-success
            @endif

            " role="progressbar"
            style="width: {{$project->getPercentCompleted()}}%"
            aria-valuenow="{{$project->getPercentCompleted()}}"
            aria-valuemin="0" aria-valuemax="100" >



            </div>

            <div class="small font-weight-bold col-sm-2 ">{{$project->getPercentCompleted()}}%</div>

        </div>
    </div>

    <!-- NOMBRE CLIENTE -->



    <!-- BOTONES -->
    <div class="col-6 p-2 col-md-2 mx-auto" >
        <a
            href="{{route('v-pj-show', $project->id)}}"
            class="btn btn-circle btn-sm bg-dark mb-1 "
            data-tooltip="tooltip" data-placement="bottom" title="View">
            <i class="far fa-eye icon-white"></i>
        </a>

        @if ( $perms == $project::PERM_ALL)

            <a
                href="{{route('v-pj-mod', $project->id)}}"
                class="btn btn-circle btn-sm bg-dark mb-1"
                data-tooltip="tooltip" data-placement="bottom" title="Edit">
                <i class="far fa-edit icon-white"></i>
            </a>

            <a
                href="{{route('f-pj-del', $project->id)}}"
                class="btn btn-circle btn-sm bg-dark mb-1"
                data-tooltip="tooltip" data-placement="bottom" title="Delete">
                <i class="far fa-trash-alt icon-white"></i>
            </a>

        @endif


    </div>

</div>

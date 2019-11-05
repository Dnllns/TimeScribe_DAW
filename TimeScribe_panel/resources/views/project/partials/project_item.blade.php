<div class="d-flex align-items-center" data-project-id="{{$project->id}}">

    <!-- NOMBRE DEL PROYECTO -->
    <p class="small font-weight-bold col-sm-2 m-0" data-toggle="tooltip" data-placement="top" title="Project name">{{$project->name}}</p>

    <p class="small font-weight-bold col-sm-2 m-0">
        <i class="fas fa-user" data-toggle="tooltip" data-placement="top" title="Client"></i>
        {{$project->getCreator()->name}}
    </p>

    
    <!-- BARRA DE PROGRESO -->
    <div class="progress col-sm-5 mr-2">
        <div class="progress-bar 
        
        @if ($project->getPercentCompleted() < 20 )
            bg-danger
        @elseif ($project->getPercentCompleted() >= 20 && $project->getPercentCompleted() < 40)
            bg-warning
        @elseif ($project->getPercentCompleted() >= 40 && $project->getPercentCompleted() > 60)
            bg-primary
        @elseif ($project->getPercentCompleted() >= 60 && $project->getPercentCompleted() > 80)
            bg-info
        @elseif ($project->getPercentCompleted() >= 80 && $project->getPercentCompleted() == 100)
            bg-success
        @endif
        
        " role="progressbar" 
        style="width: {{$project->getPercentCompleted()}}%" 
        aria-valuenow="{{$project->getPercentCompleted()}}" 
        aria-valuemin="0" aria-valuemax="100"></div>

    </div>
    <span class="small font-weight-bold mr-4">{{$project->getPercentCompleted()}}%</span>

    <!-- BOTONES -->    
    <div class="col-sm-2" >  
        <a id="a_view_{{$project->id}}" href="{{route('rt_pr_dashboard', $project->id)}}" class="btn btn-circle btn-sm bg-primary mb-1 " data-toggle="tooltip" data-placement="bottom" title="View">
            <i class="far fa-eye icon-white"></i>
        </a>

        @if ($isOwner)
        
        <a id="a_edit_{{$project->id}}" href="{{route('rt_pr_dashboard', $project->id)}}" class="btn btn-circle btn-sm bg-warning mb-1" data-toggle="tooltip" data-placement="bottom" title="Edit">
            <i class="far fa-edit icon-white"></i>
        </a>

        <a id="a_delete_{{$project->id}}" href="{{route('rt_pr_dashboard', $project->id)}}" class="btn btn-circle btn-sm bg-danger mb-1" data-toggle="tooltip" data-placement="bottom" title="Delete">
            <i class="far fa-trash-alt icon-white"></i>
        </a>

        @endif

        
    </div>


</div>
<hr>

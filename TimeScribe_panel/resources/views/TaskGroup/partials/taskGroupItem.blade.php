<!-- PROYECTOS ASIGNADOS -->
<div id="assigned-projects" class="card shadow pb-0">
    <div class="card-header py-3">
    <p class="m-0 font-weight-bold text-primary">
        {{$project->name}}                    
    </p>
    <p>{{$project->description}}</p>
    
    </div>


    <div class="card-body">


        <div class="d-flex align-items-center" data-taskgroup-id="{{$taskGroup->id}}">


            <!-- NOMBRE DEL GRUPO -->
            <div class="col-sm-2">
                <p class="small font-weight-bold m-0" data-toggle="tooltip" data-placement="top" title="Task group name">{{$taskGroup->name}}</p>
            </div>
            
            <!-- BARRA DE PROGRESO -->
            <div class="row col-sm-6 mr-2 ">
                <div class="progress col ">
                    <div class="progress-bar progress-bar-striped progress-bar-animated
                    
                    @if ($taskGroup->getPercentCompleted() < 20 )
                        bg-danger
                    @elseif ($taskGroup->getPercentCompleted() >= 20 && $taskGroup->getPercentCompleted() < 40)
                        bg-warning
                    @elseif ($taskGroup->getPercentCompleted() >= 40 && $taskGroup->getPercentCompleted() < 60)
                        bg-primary
                    @elseif ($taskGroup->getPercentCompleted() >= 60 && $taskGroup->getPercentCompleted() < 80)
                        bg-info
                    @elseif ($taskGroup->getPercentCompleted() >= 80 && $taskGroup->getPercentCompleted() == 100)
                        bg-success
                    @endif

                    " role="progressbar" 
                    style="width: {{$taskGroup->getPercentCompleted()}}%" 
                    aria-valuenow="{{$taskGroup->getPercentCompleted()}}" 
                    aria-valuemin="0" aria-valuemax="100" ></div>
                </div>
                <div class="small font-weight-bold col-sm-2 ">{{$taskGroup->getPercentCompleted()}}%</div>
            </div>
            
            <!-- ICONOS DE TODO DOING DONE -->    
            <div class="col-sm-2" >  
                <span 
                    class="btn btn-circle btn-sm bg-warning mb-1" 
                    data-tooltip="tooltip" data-placement="bottom" title="To do">
                    <strong class="text-dark">{{count($taskGroup->getTasks(0))}}</strong>
                </span>

                <span 
                    class="btn btn-circle btn-sm bg-primary mb-1 " 
                    data-tooltip="tooltip" data-placement="bottom" title="Doing">
                    <strong class="text-dark">{{count($taskGroup->getTasks(1))}}</strong>


                </span>

                <span 
                    class="btn btn-circle btn-sm bg-success mb-1 " 
                    data-tooltip="tooltip" data-placement="bottom" title="Done">
                    <strong class="text-dark">{{count($taskGroup->getTasks(2))}}</strong>


                </span>

            </div>
            
            <!-- BOTON DE COLLAPSE -->
            <div class="col-sm-2">

                <span class="btn btn-sm bg-primary mb-1" >
                    <i class="fas fa-chevron-down icon-white"></i>
                </span>

            </div>


        </div>

    </div>
</div>
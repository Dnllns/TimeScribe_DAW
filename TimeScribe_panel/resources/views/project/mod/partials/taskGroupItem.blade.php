<div class="row">

    <div class="col-12">

        <div class="row">
            <!-- NOMBRE DEL GRUPO -->
            <div class="col-8">
                <p class="m-0" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Task group name">{{$taskGroup->name}}</p>
            </div>
            <div class="col-4">
                <div class="float-right">
                    {{$taskGroup->getStatusIcon()}}
                    {{$taskGroup->getVisibilityIcon()}}
                </div>
                
            </div>
        </div>




    </div>

    

</div>
    
    
        
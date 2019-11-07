@switch($type)

    @case('START')
        <i  data-funct="start"
            data-ajax-route="{{route('taskCard-setStarted', $task->id)}}"
            class="far fa-play-circle text-success pb-1"
            data-tooltip="tooltip" data-placement="bottom" title="Start task">
        </i>
        @break

    @case('VIEW')
        <i  data-funct="view"
            class="far fa-eye text-info pb-1"
            data-tooltip="tooltip" data-placement="bottom" title="View task"
            data-toggle="collapse" data-target="#task-data-{{$task->id}}">
        </i>
        @break

    @case('SELECT')
        <i  data-funct="select" data-chronofunct="start"
            class="fas fa-hourglass-start text-warning pb-1"
            data-tooltip="tooltip" data-placement="bottom" title="Select task">
        </i>
        @break

    @case('DONE')
        <i  data-funct="done" 
            data-ajax-route="{{route('taskCard-setDone', $task->id)}}"
            class="far fa-check-circle text-success pb-1"
            data-tooltip="tooltip" data-placement="bottom" title="Set done">
        </i>
        @break

    @case('DELETE')
        <i  data-funct="delete" 
            data-ajax-route="{{route('taskCard-setDelete', $task->id)}}"
            class="far fa-trash-alt text-danger pb-1"
            data-tooltip="tooltip" data-placement="bottom" title="Remove task">
        </i>
        @break
@endswitch


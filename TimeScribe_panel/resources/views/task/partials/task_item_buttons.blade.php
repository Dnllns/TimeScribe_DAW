@switch($type)

    @case('START')
        <i  data-funct="start"
            data-ajax-route="{{route('f-ts-setstarted', $task->id)}}"
            class="far fa-play-circle text-white float-right btn-sm px-2 "
            data-tooltip="tooltip" data-placement="bottom" title="Start task">
        </i>
        @break

    @case('VIEW')
        <i  data-funct="view"
            class="far fa-eye text-white float-right btn-sm px-2"
            data-tooltip="tooltip" data-placement="bottom" title="View task"
            data-toggle="collapse" data-target="#task-data-{{$task->id}}">
        </i>
        @break

    @case('SELECT')
        <i  data-funct="select" data-chronofunct="start"
            class="fas fa-hourglass-start text-white float-right btn-sm px-2"
            data-tooltip="tooltip" data-placement="bottom" title="Select task">
        </i>
        @break

    @case('DONE')
        <i  data-funct="done"
            data-ajax-route="{{route('f-ts-setdone', $task->id)}}"
            class="far fa-check-circle text-white float-right btn-sm px-2"
            data-tooltip="tooltip" data-placement="bottom" title="Set done">
        </i>
        @break

    @case('DELETE')
        <i  data-funct="delete"
            data-ajax-route="{{route('f-ts-setdeleted', $task->id)}}"
            class="far fa-trash-alt text-white float-right btn-sm px-2 py-2"
            data-tooltip="tooltip" data-placement="bottom" title="Remove task">
        </i>
        @break
@endswitch


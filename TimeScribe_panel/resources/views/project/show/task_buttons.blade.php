@switch($type)
    @case('START')
        <i  data-funct="start"
            data-ajax-route="{{route('f-ts-setstarted', $task->id)}}"
            class="far fa-play-circle text-white btn-sm"
            data-tooltip="tooltip" data-placement="bottom" title="Start task">
        </i>
        @break
    @case('VIEW')
        <i  data-funct="view"
            class="fas fa-chevron-down text-white btn-sm"
            data-tooltip="tooltip" data-placement="bottom" title="View task"
            data-toggle="collapse" data-target="#task-data-{{$task->id}}">
        </i>
        @break
    @case('SELECT')
        <i  data-funct="select" data-chronofunct="start"
            class="fas fa-hourglass-start text-white btn-sm"
            data-tooltip="tooltip" data-placement="bottom" title="Select task">
        </i>
        @break
    @case('DONE')
        <i  data-funct="done"
            data-ajax-route="{{route('f-ts-setdone', $task->id)}}"
            class="far fa-check-circle text-white btn-sm"
            data-tooltip="tooltip" data-placement="bottom" title="Set done">
        </i>
        @break
    @case('DELETE')
        <i  data-funct="delete"
            data-ajax-route="{{route('f-ts-setdeleted', $task->id)}}"
            class="far fa-trash-alt text-white btn-sm"
            data-tooltip="tooltip" data-placement="bottom" title="Remove task">
        </i>
        @break
@endswitch


{{--
@switch($type)

    @case('START')

        <span
        data-funct="start"
        data-ajax-route="{{route('f-ts-setstarted', $task->id)}}"
        data-tooltip="tooltip" data-placement="bottom" title="Start task"
        class="text-white btn-sm">
            <i class="far fa-play-circle"></i>
        </span>
        @break

    @case('VIEW')

        <span
        data-funct="view"
        data-tooltip="tooltip" data-placement="bottom" title="View task"
        data-toggle="collapse" data-target="#task-data-{{$task->id}}"
        class="text-white btn-sm">
            <i class="fas fa-chevron-down"></i>
        </span>
        @break

    @case('SELECT')



        <span
        data-funct="select"
        data-tooltip="tooltip" data-placement="bottom" title="Select task"
        class="text-white btn-sm">
            <i class="fas fa-hourglass-start"></i>
        </span>

        @break

    @case('DONE')

        <span
        data-funct="done"
        data-ajax-route="{{route('f-ts-setdone', $task->id)}}"
        data-tooltip="tooltip" data-placement="bottom" title="Set done"
        class="text-white btn-sm">
            <i class="far fa-check-circle"></i>
        </span>

        @break

    @case('DELETE')

        <span
        data-funct="delete"
        data-ajax-route="{{route('f-ts-setdeleted', $task->id)}}"
        data-tooltip="tooltip" data-placement="bottom" title="Remove task"
        class="text-white btn-sm">
            <i class="far fa-trash-alt"></i>
        </span>

        @break
@endswitch --}}

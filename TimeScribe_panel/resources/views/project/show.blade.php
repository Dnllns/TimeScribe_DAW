@extends('layouts.app')

@section('head')

    <!-- STYLES -->
    <link rel="stylesheet" href="/JqueryUi/jquery-ui.min.css">
    <link rel="stylesheet" href="/JqueryUi/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="/JqueryUi/jquery-ui.theme.min.css">

    <!-- LIBS -->
    <script src="/js/jquery-3.4.1.js"></script>
    <script src="/JqueryUi/jquery-ui.min.js"></script>

    <!-- -------------SCRIPTS---------------- -->
    {{-- <script src="/js/funcionesComunes.js"></script> --}}
    <!-- Primero las peticiones al server -->
    <script src="/js/project/show/ajax_updates.js"></script>
    <script src="/js/project/show/chrono-old.js"></script>
    <script src="/js/project/show/chronoSticky.js"></script>

    <!-- Para hacer drag and drop -->
    <!-- <script src="/js/pr_dashboard/draggable.js"></script> -->

@endsection


@section('content')

    <!-- Plantilla de sticky chrono -->
    @include('task.partials.sticky_chrono' )



    <div class="card shadow col-sm-10 mx-auto p-0">
        <div class="card-header">
            <div class=""><h2  class="m-0">{{$project->name}}</h2></div>
            <div>{{$project->description}}</div>
        </div>
        <div class="card-body m-4">
            @if( $taskGroups != null)
                @foreach ($taskGroups as $taskGroup)
                <div data-taskgroup='{{$taskGroup->id}}'>
                    @include('taskgroup.partials.taskgroup_item', ['taskGroup' => $taskGroup])
                </div>
                @endforeach
            @else
                {{-- No hay grupos de tareas --}}
                @include(
                    'common.alert',
                    [
                        'style' => "warning",
                        'content' =>
                            "Currently no task group has been added.".
                            " You can start " .
                            "<a href='/taskgroup-new/" . $project->id . "'>creating a new one</a>"
                    ]
                )

            @endif
        </div>
    </div>





@endsection

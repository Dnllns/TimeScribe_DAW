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
    <script src="/js/funcionesComunes.js"></script>
    <!-- Primero las peticiones al server -->
    <script src="/js/pr_dashboard/ajax_updates.js"></script>
    <script src="/js/pr_dashboard/chrono.js"></script>
    <script src="/js/pr_dashboard/chronoSticky.js"></script>

    <!-- Para hacer drag and drop -->
    <!-- <script src="/js/pr_dashboard/draggable.js"></script> -->

@endsection


@section('content')

    <!-- Plantilla de sticky chrono -->
    @include('task.partials.sticky_chrono' )

    {{-- <h1>Project dashboard</h1> --}}

    <!-- PROYECTOS ASIGNADOS -->
    <div id="assigned-projects" class="card shadow col-sm-10 mx-auto pb-0">
        <div class="card-header p-2 mt-3">
            <p class="m-0 font-weight-bold text-primary">{{$project->name}}</p>
            <p>{{$project->description}}</p>
        </div>
        <div class="card-body">
            @if( $taskGroups != null)
                @foreach ($taskGroups as $taskGroup)
                    @include('taskgroup.partials.taskgroup_item', ['taskGroup' => $taskGroup])
                @endforeach
            @else
                {{-- No hay grupos de tareas --}}
                @include('common.alert', ['style' => "warning", 'content' => "Currently no task group has been added."] )

            @endif
        </div>
    </div>





@endsection
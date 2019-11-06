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
    <!-- Para hacer drag and drop -->
    <!-- <script src="/js/pr_dashboard/draggable.js"></script> -->

@endsection


@section('content')

    <!-- Plantilla de sticky chrono -->
    @include('task.partials.StickyChrono' )


    <div class="col-sm-10 p-10">

    <!-- PROYECTOS ASIGNADOS -->
    <div id="assigned-projects" class="card shadow pb-0">
        <div class="card-header py-3">
            <p class="m-0 font-weight-bold text-primary">{{$project->name}}</p>
            <p>{{$project->description}}</p>
        </div>
        <div class="card-body">
            @foreach ($taskGroups as $taskGroup)
                @include('taskGroup.partials.taskGroupItem', ['tasks' => $taskGroup->getTasks(2)])
            @endforeach
        </div>
    </div>

@endsection

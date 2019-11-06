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
    <script src="/js/pr_dashboard/draggable.js"></script>

@endsection


@section('content')



    <!-- Plantilla de sticky chrono -->
    @include('task.partials.StickyChrono' )


    @foreach ($taskGroups as $taskGroup)

        <div class="col-sm-10 p-10">
            @include('taskGroup.partials.taskGroupItem' )
        </div>

    @endforeach

@endsection
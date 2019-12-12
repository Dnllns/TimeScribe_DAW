@extends('layouts.app')

@section('head')

    <!-- STYLES -->


    <!-- LIBS -->
    <script src="/js/jquery-3.4.1.js"></script>

    <!-- -------------SCRIPTS---------------- -->
    {{-- <script src="/js/funcionesComunes.js"></script> --}}
    <!-- Primero las peticiones al server -->
    <script src="/js/project/show/ajax_updates.js"></script>
    <script src="/js/project/show/chrono-old.js"></script>
    <script src="/js/project/show/del_taskgroup.js"></script>
    <script src="/js/project/show/collapse_task_list.js"></script>



    <!-- Para hacer drag and drop -->

@endsection


@section('content')

    <!-- Plantilla de sticky chrono -->

<div class="row">

    @include('project.show.sticky_chrono' )

    <div class="card shadow col-12 mx-auto p-0">

        <div class="card-header">
            @include(
                'common.card-header-content', 
                [
                    'title' => "Show project",
                    'breadCrumbs' => $project->getBreadCrumbs(),
                    'id' => $project->id
                ]
            )                   
        </div>

        <div class="card-body mt-2 mb-4">

            <div class="row mb-4">

                <div class="col-12 pl-3">
                    <label for="description"  class="m-0"><strong>Description:</strong></label>
                    <div name="description">{{$project->description}}</div>
                </div>

            </div>


            @if( $taskGroups != null)
                <ul class="list-group">
                @foreach ($taskGroups as $taskGroup)
                <li class="list-group-item">
                    <div data-taskgroup='{{$taskGroup->id}}'>
                        @include('project.show.taskgroup', ['taskGroup' => $taskGroup])
                    </div>
                </li>
                @endforeach
                </ul>
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

</div>




@endsection

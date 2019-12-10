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

    @include('task.partials.sticky_chrono' )

    <div class="card shadow col-12 mx-auto p-0">

        <div class="card-header">

            <div class="row">
                <div class="col-12 my-auto col-md-6">
                    <h1 class="my-auto text-uppercase"> Show project</h1>

                </div>

                <div class="col col-md-5 my-auto text-uppercase">
                    <div class="text-md-right">
                        {!! $project->getBreadCrumbs() !!}
                    </div>
                </div>

                <div class="col-1  my-auto">
                    <div class="float-right">
                        <i class="far fa-id-card">{{$project->id}}</i>
                    </div>
                </div>
            </div>

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

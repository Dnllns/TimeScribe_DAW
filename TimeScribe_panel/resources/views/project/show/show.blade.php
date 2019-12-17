@extends('layouts.app')

@section('head')

    <!-- STYLES -->


    <!-- LIBS -->
    <script src="/js/jquery-3.4.1.js"></script>

    <!-- -------------SCRIPTS---------------- -->
    {{-- <script src="/js/funcionesComunes.js"></script> --}}
    <!-- Primero las peticiones al server -->
    <script src="/js/project/show/ajax_updates.js"></script>
    <script src="/js/project/show/chrono.js"></script>
    <script src="/js/project/show/del_taskgroup.js"></script>
    <script src="/js/project/show/collapse_task_list.js"></script>



    <!-- Para hacer drag and drop -->

@endsection


@section('content')

<script>
    window.history.pushState('', '', '/project-show/{{$project->id}}');
</script>

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

        <div class="card-body">

            {{-- DESCRIPCION --}}
            <div class="row mb-3">

                <div class="col-12 pl-3">
                    <label for="description"  class="m-0"><strong>Description:</strong></label>
                    <div name="description">{{$project->description}}</div>
                </div>

            </div>

            {{-- BOTONES --}}
            @if( auth()->user()->is_admin == 1 or $project->getUserPermission() == 1 )

            {{-- Boton de añadir proyecto --}}
            <div class="row my-3 pb-1">
                <div class="col-12">

                    <div class="float-right">
                        <a class="btn btn-secondary btn-sm text-white" href="{{ route('v-pj-mod', ['projectId'=> $project->id])}}">
                            <span class="btn-label"><i class="far fa-edit"></i></span>&nbsp;
                            Edit project
                        </a>
                    </div>

                    <div class="float-right pr-2">
                        <a class="btn btn-primary btn-sm text-white" href="{{ route('v-tg-new', ['projectId'=> $project->id])}}">
                            <span class="btn-label"><i class="fas fa-plus"></i></span>&nbsp;
                            Add new task group
                        </a>
                    </div>

                </div>
            </div>

            @endif

            {{-- LISTA DE GRUPOS DE TAREAS --}}
            <div class="row my-3">
                <div class="col-12">
                @if( $taskGroups != null)


                    <ul class="list-group">
                        @foreach ($taskGroups as $taskGroup)

                            @if($taskGroup['visible'] == $taskGroup::VISIBLE)

                                <li class="list-group-item">
                                    <div data-taskgroup='{{$taskGroup->id}}'>
                                        @include('project.show.taskgroup', ['taskGroup' => $taskGroup])
                                    </div>
                                </li>

                            @elseif($permissions==$project::PERM_ALL)

                                <li class="list-group-item">
                                    <div data-taskgroup='{{$taskGroup->id}}'>
                                        @include('project.show.taskgroup', ['taskGroup' => $taskGroup])
                                    </div>
                                </li>


                            @endif


                        @endforeach
                    </ul>
                @else

                    {{-- No hay grupos de tareas --}}
                    @php

                    $extra = "";
                    if(auth()->user()->is_admin == 1){
                        $extra = " You can start" .
                        "<a href='" . route('v-tg-new', [$project->id]) . "'> <strong>creating a new task group</strong></a>.";
                    }

                    $content = "The project <b>" . $project->name . "</b> is empty." . $extra;
                    @endphp

                    @include('common.alert', ['style' => "warning", 'content' => $content] )

                @endif

                </div>
            </div>
        </div>
    </div>

</div>




@endsection

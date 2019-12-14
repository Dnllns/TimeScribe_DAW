
@extends('layouts.app')

@section('content')
<script>

    window.history.pushState('', '', '/workgroup-show/{{$workGroup->id}}');

</script>


<div class="row">
    <div class="col-12 mx-auto">
        <div class="card pb-2">


            <div class="card-header">

                @include('
                    common.card-header-content',
                    [
                        "title" => "Select a project",
                        "breadCrumbs" => $workGroup->name,
                        'id' => $workGroup->id
                    ]

                )



            </div>

            <div class="card-body m-2">

                @if( auth()->user()->is_admin == 1 )

                    {{-- Botones --}}
                    <div class="row">
                        <div class="col-12 mb-4">

                            <div class="float-right">
                                <a class="btn btn-secondary btn-sm text-white" href="{{ route('v-wg-mod', ['workGroupId'=> $workGroup->id])}}">
                                    <span class="btn-label"><i class="far fa-edit"></i></span>&nbsp;
                                    Edit workgroup
                                </a>
                            </div>

                            <div class="float-right pr-2">
                                <a class="btn btn-primary btn-sm text-white" href="{{ route('v-pj-new', ['workGroupId'=> $workGroup->id])}}">
                                    <span class="btn-label"><i class="fas fa-plus"></i></span>&nbsp;
                                    Add new project
                                </a>
                            </div>

                        </div>
                    </div>

                @endif


                @if ($userProjects->count() == 0)

                    {{-- Mostrar alerta --}}
                    @php

                        $extra = "";
                        if(auth()->user()->is_admin == 1){
                            $extra = " You can start" .
                            "<a href='" . route('v-pj-new', ['workGroupId'=> $workGroup->id]) . "'> <strong>creating a new Project</strong></a>";
                        }
                        $content = "The workgroup " . $workGroup->name . " is empty." . $extra;

                    @endphp

                    @include('common.alert', ['style' => "warning", 'content' => $content] )

                @else

                    {{-- Lista de proyectos --}}
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group">
                                @foreach ($userProjects as $project)

                                    @php
                                        $userPermissions=$project->getUserPermission();
                                    @endphp

                                    @if(
                                        $userPermissions == $project::PERM_ALL or
                                        $userPermissions == $project::PERM_WORK
                                    )

                                        <li class="list-group-item">
                                            @include('workgroup.show.project_item', ['perms' => $userPermissions])
                                        </li>

                                    @endif

                                @endforeach
                            </ul>
                        </div>
                    </div>

                @endif


            </div>
        </div>
    </div>
</div>


@endsection

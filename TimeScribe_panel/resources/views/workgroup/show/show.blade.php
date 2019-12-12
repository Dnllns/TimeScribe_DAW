
@extends('layouts.app')

@section('content')
<script>

    window.history.pushState('', '', '/workgroup-show/{{$workGroup->id}}');

</script>


<div class="row">
    <div class="col-12 mx-auto">
        <div class="card">


            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h1 class="my-auto text-uppercase">Select a project</h1>
                    </div>

                    <div class="col-auto col-md-5 my-auto text-uppercase">
                        <div class="float-right">
                            {{$workGroup->name}}
                        </div>
                    </div>

                    <div class="col-auto col-md-1 my-auto">
                        <div class="float-right">
                            <i class="far fa-id-card">{{$workGroup->id}}</i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-body m-4">

                @if(
                    auth()->user()->is_admin == 1 or
                    $project->getUserPermission(auth()->user()->id) == 0
                )


                {{-- Boton de añadir proyecto --}}
                <div class="row">
                    <div class="col-12 mb-4">

                        <div class="float-right">
                            <a class="btn btn-warning btn-sm text-white" href="{{ route('v-wg-mod', ['workGroupId'=> $workGroup->id])}}">
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

                    @php
                        $content = "The workgroup" . $workGroup->name . "is empty. You can start" .
                        "<a href='" . route('v-pj-new', ['workGroupId'=> $workGroup->id]) . "'> <strong>creating a new Project</strong></a>";
                    @endphp

                    @include('common.alert', ['style' => "warning", 'content' => $content] )

                @else

                    {{-- Lista de proyectos --}}
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group">
                                @foreach ($userProjects as $project)

                                    @php
                                        $userPermissions=$project->getUserPermission(auth()->user()->id);
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

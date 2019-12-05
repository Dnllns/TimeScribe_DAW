
@extends('layouts.app')

@section('content')
<script>

    window.history.pushState('', '', '/workgroup-show/{{$workGroup->id}}');

</script>


<div class="row">
    <div class="col-10 mx-auto">
        <div class="card">

            <div class="card-header">
                <h1 class="m-0">Select a project</h1>
            </div>

            <div class="card-body m-4">

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
                                        @include('project.partials.project_item', ['perms' => $userPermissions])
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

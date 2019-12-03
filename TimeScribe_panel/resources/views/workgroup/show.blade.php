
@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-10 mx-auto">
        <div class="card">

            <div class="card-header">
                <h1 class="m-0">Select a project</h1>
            </div>

            <div class="card-body m-4">

                @if ($userProjects->count() == 0)

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        The workgroup {{$workGroup->name}} is empty. You can start 
                        <a href="{{route('v-pj-new', ['workGroupId'=> $workGroup->id])}}"> <strong>creating a new Project</strong></a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                
                @else 
                
                    {{-- Lista de proyectos --}}
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group">
                                @foreach ($userProjects as $project)
                    
                                    @if( 
                                        $project->getUserPermission(auth()->user()->id) == $project::PERM_ALL or
                                        $project->getUserPermission(auth()->user()->id) == $project::PERM_WORK 
                                    )
                    
                                    
                                        <li class="list-group-item">
                                            @include('project.partials.project_item', ['perms' => $project->getUserPermission(auth()->user()->id)])
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
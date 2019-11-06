@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <h1 class="pb-4">Select a project</h1>

        <!-- MIS PROPIOS PROYECTOS -->
        <div id="my-own-projects" class="card shadow m-4 pb-0">
            <div class="card-header py-3">
            <p class="m-0 font-weight-bold text-primary">
                My own projects
                <button class="btn float-right" data-toggle="collapse" data-target=".collapse-my-own-projects">
                    <i class="fas fa-chevron-down"></i>
                </button>
                            
            </p>
            
            </div>
            <div class="card-body collapse-my-own-projects collapse">
                @foreach ($userProjects as $project)
                    @include('project.partials.project_item', ['isOwner' => true])
                @endforeach
            </div>
        </div>


        <!-- PROYECTOS ASIGNADOS -->
        <div id="assigned-projects" class="card shadow m-4 pb-0">
            <div class="card-header py-3">
            <p class="m-0 font-weight-bold text-primary">
                Assigned projects
                <button class="btn float-right" data-toggle="collapse" data-target=".collapse-assigned-projects">
                    <i class="fas fa-chevron-down"></i>
                </button>
                            
            </p>
            
            </div>
            <div class="card-body collapse-assigned-projects collapse">
                @foreach ($userProjects as $project)
                    @include('project.partials.project_item', ['isOwner' => false])
                @endforeach
            </div>
        </div>

    </div>

</div>

@endsection


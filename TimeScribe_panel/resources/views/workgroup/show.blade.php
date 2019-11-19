
@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <h1 class="pb-4">Select a project</h1>

        @if ($userProjects->count() == 0)

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                The workgroup {{$workGroup->name}} is empty. You can start 
                <a href="{{route('v-pj-new', ['workGroupId'=> $workGroup->id])}}"> <strong>creating a new Project</strong></a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

        @else 

            {{-- Lista de prollectos --}}
            <div class="row">
                <div class="col-12">
                    @foreach ($userProjects as $project)
                        @include('project.partials.project_item', ['isOwner' => true])
                    @endforeach
                </div>
            </div>

        @endif


        

    </div>

</div>

@endsection
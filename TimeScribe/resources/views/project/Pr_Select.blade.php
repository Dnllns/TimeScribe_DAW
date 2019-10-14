@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <h2>Project list</h2>


        @foreach ($userProjects as $project)


            <div class="">
                <label class="control-label col-sm-6" for="name">Project id: {{ $project->id }}</label>

                <div class="col-sm-6">
                    <ul>
                        <li>Name: {{ $project->name }}</li>
                        <li>Description: {{ $project->description }}</li>
                        <li>Client: {{ $project->client_id }}</li>
                        <li>Status: {{ $project->status }}</li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary">Visualize</a>
                    <a class="btn btn-primary" href="{{route('rt_pr_edit', $project)}}" >Edit</a>
                    <a class="btn btn-primary">Delete</a>
                </div>
                
            </div>



        @endforeach
        
    </div>



</div>

@endsection

@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src=""></script>
@endsection

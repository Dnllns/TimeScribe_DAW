@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <h2>Project list</h2>


        @foreach ($userProjects as $project)


            <div class="d-flex ">

                <div class="col-sm-6">
                    <h3>{{ $project->name }}</h3>
                    <p>{{ $project->description }}</p>
                    <ul>
                        <li>Project id: {{ $project->id }}</li>
                        <li>Client: {{ $project->client_id }}</li>
                        <li>Status: {{ $project->status }}</li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary" href="{{route('rt_pr_dashboard', $project->id)}}">Visualize</a>
                    <a class="btn btn-primary" href="{{route('rt_pr_edit', $project->id)}}" >Edit</a>
                    <a class="btn btn-primary" href="{{route('rt_pr_delete', $project->id)}}" onclick="return confirm('Deleting project...\nAre you sure?')"> Delete</a>
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

@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <h2>Project list</h2>


        @foreach ($userProjects as $project)


            <div class="my-group">

                <div class="d-flex">
                    <h3 class="col-sm-9">{{ $project->name }}</h3>

                    <!-- ACTION BUTTONS -->
                    <div class="col-sm-3 justify-content-end">
                        <button class="btn btn-primary" type="button" onclick="location.href='{{route('rt_pr_dashboard', $project->id)}}'">
                            <i class="far fa-eye icon-white"></i>
                        </button>
                        <button class="btn btn-primary" type="button" onclick="location.href='{{route('rt_pr_edit', $project->id)}}'">
                            <i class="fas fa-edit"></i> 
                        </button>

                        <button class="btn btn-primary" type="button" 
                        onclick="if(confirm('Deleting project...\nAre you sure?')){ location.href='{{route('rt_pr_delete', $project->id)}}'}">
                            <i class="fas fa-trash-alt"></i>                    
                        </button>
                    </div>

                </div>
                    
                <div class="pl-4"> 
                    <!-- <i class="fas fa-pen-alt"></i> -->
                    {{ $project->description }}
                </div>
                <ul>

                    <li>Project id: {{ $project->id }}</li>
                    <li><i class="fas fa-user-tag"></i> {{ $project->client_id }}</li>
                    <li>Status: {{ $project->status }}</li>
                </ul>
                

                

            </div>



        @endforeach

    </div>



</div>

@endsection

@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src=""></script>
@endsection

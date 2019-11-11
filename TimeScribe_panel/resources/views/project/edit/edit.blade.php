@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <div class="row">
            <h1 class="col-11">Edit project</h1>
            <div class="col-1 my-auto">   
                <i class="far fa-id-card float-right">{{ $project->id }}</i>
            </div>
        </div>
        


        <form class="" method="post" action="{{ route('rt_pr_update', $project->id) }}">

            @csrf <!-- {{ csrf_field() }} -->


            {{-- DATOS DEL PROYECTO --}}


            <div class="row mb-2">
                <h3 class="col-11">Project data</h3>
                <div class="col-1">
                    <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target="#project-data" >
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>

            <div id="project-data" class="row collapse mb-4">

                <!-- PROJECT NAME  -->
                <div class="form-group col-5 mb-4">
                    <label class="control-label" for="name">Project name:</label>
                    <div class="input-group">               
                        <input id="name" type="text" class="form-control" placeholder="Enter project name" name="name" value="{{ $project->name }}" > 
                    </div>
                </div>
                


                <!-- PROJECT DESCRIPTION -->
                <div class="form-group col-12">
                    <label class="control-label" for="description">Description:</label>
                    <textarea id="description" class="form-control" rows="5" placeholder="Enter description" name="description" value="{{ $project->description }}"></textarea>
                </div>


            </div>

            


            <!-- CLIENT CONFIGURATION --> 
            <div class="row mb-2">
                <h3 class="col-11">Client configuration</h3>
                <div class="col-1">
                    <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target="#client-data" >
                        <i class="fas fa-chevron-down"></i>
                    </button>  
                </div>
                
            </div>

            <div id="client-data" class="row collapse mb-3">

                <!-- SELECTOR -->
                <div class="form-group col-lg-6">
                    <label class="control-label">Find client:</label>
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-outline-secondary">Search</button>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Find by id</a>
                            <a class="dropdown-item" href="#">Find by email</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Find all</a>
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
                    </div>
                    
                </div>

                <!-- CLIENT EMAIL -->
                <div class="form-group col-lg-3">                       
                    <label class="control-label" for="client_email">Client email:</label>
                    <input type="text" class="form-control" id="client_email" placeholder="Enter client email" name="client_email" value="{{ $client->email }}">
                </div>
                
                <!-- CLIENT NAME  -->
                <div class="form-group col-lg-3">                       
                    
                    <label class="control-label" for="client_name">Client name:</label>
                    <input type="text" class="form-control" id="client_name" placeholder="Enter client name" name="client_name" value="{{ $client->name }}">
                </div>

                
                                    
            </div>
            




            <!-- TASK GROUP CONFIGURAION -->

            <div class="row mb-2">
                <h3 class="col-11">Task group configuration</h3>
                <div class="col-1">
                    <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target="#taskgroup-data" >
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                
            </div>

            <div id="taskgroup-data" class="collapse mb-3">

                @foreach ($taskGroups as $group)

                    <div class="d-flex ">
                        <div class="col-sm-10">
                            <h4>{{ $group->name }}</h4>
                            <p>{{ $group->description }}</p>
                            <ul>
                                <li>Status: {{ $group->status }}</li>
                                <li>
                                    % Completed: 
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                </li>
                                <li>
                                    <p>Assigned Developers</p>
                                    <ul>
                                        <li>AAA</li>
                                        <li>AAA</li>
                                        <li>AAA</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-primary" href="{{route('rt_tg_edit', $group->id)}}" >Edit</a>
                            <a class="btn btn-primary" href="{{ route('rt_tg_delete', $group->id) }}" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>

                    </div>
                    
                    <hr style="color: #0056b2;" />

                @endforeach

                <br>
                <a class="btn btn-primary" href="{{ route('rt_tg_new', $project->id ) }}">Add new task group</a>

            </div>


            <!-- SAVE BUTTON -->
            <div class="row">
                <div class="col-12">  
                    <button class="btn btn-primary float-right" type="button" >Save changes</button>
                </div>
            </div>

            

            
        </form>



    </div>

</div>

@endsection


@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src=""></script>
@endsection
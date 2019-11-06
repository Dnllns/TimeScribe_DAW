@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <h1>Edit project</h1>

        <h2>Project Id {{ $project->id }}</h2>


        <form class="form-horizontal" method="post" action="{{ route('rt_pr_update', $project->id) }}">

            @csrf <!-- {{ csrf_field() }} -->


            <!-- PROJECT NAME  -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Project name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter project name" name="name" 
                    value="{{ $project->name }}" >
                </div>
            </div>


            <!-- PROJECT DESCRIPTION -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" 
                    value="{{ $project->description }}">
                </div>
            </div>


            <!-- CLIENT CONFIGURATION -->
            <fieldset class="border p-2">
                <legend  class="w-auto">Client configuration</legend>

                <div class="container">
    
                    <!-- CLIENT EMAIL -->
                    <div class="form-group">                       
                        <label class="control-label" for="client_email">Client email:</label>
                        <div class="">
                            <input type="text" class="form-control" id="client_email" placeholder="Enter client email" name="client_email"
                            value="{{ $client->email }}">
                        </div>
                    </div>

                    <div class="form-group">                       
                        <!-- CLIENT NAME  -->
                        <label class="control-label" for="client_name">Client name:</label>
                        <div class="">
                            <input type="text" class="form-control" id="client_name" placeholder="Enter client name" name="client_name"
                            value="{{ $client->name }}">
                        </div>                      
                    </div>

                    <!-- SELECTOR -->
                    <div class="input-group col-sm-10">
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
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
                    </div>
                                        
                </div>
            </fieldset>
            <br>
            
            <!-- TASK GROUP CONFIGURAION -->
            <fieldset class="border p-2">
                <legend  class="w-auto">Task Groups</legend>



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


            </fieldset>

            <br>

            <!-- SAVE BUTTON -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Save changes</button>
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
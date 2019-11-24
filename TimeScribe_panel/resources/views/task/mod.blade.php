@extends('layouts.app')


@section('head')
    <script src="/js/task/task_mod_functions.js"></script>
@endsection

@section('content')
<div class="container">


    {{-- Alert message for when new task is created --}}
    @if (isset($isNew))
        <div class= "row">
            <div class="col-12 mb-2">
                @include(
                    'common.alert',
                    [
                        'style' => "success",
                        'content' => "The task <strong>"  . $task->name . "</strong> has been successfully created."
                    ]
                )  
            </div>
                      
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div id="taskcard" data-taskid="{{$task->id}}" class="card-header"><strong>Edit task</strong></div>

                <div class="card-body m-4">


                    <form method="post" action="{{ route('f-ts-mod', ['taskId'=>$task->id]) }}">
                        @csrf


                        {{-- Datos de la tarea --}}
                        <div class="row pb-2">

                            <p><strong>Task data</strong></p>

                            <div class="col-12">
                                <label class="control-label" for="name">Name:</label>
                                <div class="input-group mb-2">
                                    <input id="name" name="name" type="text" placeholder="My workgroup"  value="{{$task->name}}" class="form-control input-md">
                                </div>
                            </div>

                            <!-- PROJECT DESCRIPTION -->
                            <div class="form-group col-12">
                                <label class="control-label" for="description">Description:</label>
                                <textarea id="description" class="form-control" rows="5" placeholder="Enter description" name="description">{{ $task->description }}</textarea>
                            </div>

                        </div>

                        <hr>

                        {{-- USUARIOS --}}
                        <div class="row pb-2">


                            {{-- Lista de usuarios --}}
                            <div id="project-devs-container" class="col-12 pb-4">
                                <p><strong>Developer list</strong></p>


                                @if ($taskDevelopers == null)
                                {{-- Sin developers asignados --}}

                                    <div id="alert-dev-list">
                                    <!-- Mensaje de alerta -->
                                        @include('common.alert', ['style' => "warning", 'content' => "Currently no developer has been added."] )
                                    </div>
                                @else
                                {{-- Existen developers --}}

                                    <div id="dev-list">  
                                        <ul>
                                            @foreach ($taskDevelopers as $developer)
                                            <li>
                                                <div class="row">
                                                    <div class="col data-item" data-id="{{$developer->id}}">
                                                        {{$developer->name}}, {{$developer->email}}
                                                    </div>
                                                    <div class="col">
                                                        <a 
                                                        data-id="{{$developer->id}}" data-funct="{{ route( 'f-ts-deldev', ['taskId' => $task->id, 'devId' => $developer->id ] ) }}" 
                                                        href="" class="btn btn-sm text-danger f-remove">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                @endif

                            </div>

                            {{-- Añadir --}}
                            <div class="col-12 pb-4">
                                <p><strong>Add developers</strong></p>

                                <div class="form-group col">
                                    <p>Find developers in this project:</p>

                                    <div class="row">
                                        <div id="workgroup-devs-container" class="col-12">

                                            @if ( $projectDevelopers == null)
                                            {{-- No hay developers --}}

                                            <div id="alert-select-devs">
                                                @include('common.alert', ['style' => "warning", 'content' => "There isn't more developers availables"] )
                                            </div>

                                            @else
                                            {{-- Seleccionador de developers --}}

                                            <div id="select-devs" class="row">

                                                <div class="col-6">
                                                    <select class="browser-default custom-select">
                                                        @foreach ( $projectDevelopers as $dev)
                                                            <option value="{{$dev->id}}">{{$dev->name}}, {{$dev->email}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col my-auto">
                                                    <a id="adddev" class="btn btn-sm btn-primary float-right"    
                                                    data-funct="{{route('f-ts-adddev', [ 'taskId' =>  $task->id , 'devId' => "devId" ] )}}" 
                                                    href="" >Add selected</a>
                                                </div>
                                            </div>

                                            @endif


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- BOTON GUARDAR --}}
                        <div class="row">
                            <div class="col-12">
                                <button id="save" name="save" class="btn btn-success  float-right">Save</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

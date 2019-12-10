@extends('layouts.app')


@section('head')
    <script src="/js/task/task_mod_functions.js"></script>
@endsection

@section('content')



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

<div class="row">
    <div class="col-10 mx-auto">
        <div class="card">

            <div id="taskcard" data-taskid="{{$task->id}}" class="card-header">
                    <div class="row">

                        <div class="col-12  my-auto col-md-4">
                            <h1 class="text-uppercase m-0">Edit task</h1>
                        </div>

                        <div class="col-sm-12 col-md-8 my-auto text-uppercase">
                            <div class="row">
                                <div class="col-10 text-left text-md-right ">
                                    {!!$task->getBreadCrumbs()!!}
                                </div>
                                <div class="col-2 text-right">
                                    <i class="far fa-id-card">{{$task->id}}</i>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


            <div class="card-body m-4">


                <form method="post" action="{{ route('f-ts-mod', ['taskId'=>$task->id]) }}">
                    @csrf


                    {{-- Datos de la tarea --}}
                    <div class="row pb-2">

                        <h2>Task data</h2>

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


                        <!-- VISIBILITY -->
                        <div class="col-12">
                            <label class="control-label" for="visible">Visibility status:</label>

                            <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="r1" name="visible" value="0"

                            @if ($task['visible'] == 0)
                                checked
                            @endif

                            >
                                <label class="custom-control-label" for="r1">Not visible</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="r2" name="visible" value="1"

                                @if ($task['visible'] == 1)
                                    checked
                                @endif

                                >
                                <label class="custom-control-label" for="r2">Visible</label>
                            </div>
                        </div>

                    </div>

                    <hr>

                    {{-- USUARIOS --}}
                    <div class="row pb-2">


                        {{-- Lista de usuarios --}}
                        <div id="project-devs-container" class="col-12 pb-4">
                            <h2>Developer list</h2>


                            @if ($taskDevelopers == null)
                            {{-- Sin developers asignados --}}

                                <div id="alert-dev-list">
                                <!-- Mensaje de alerta -->
                                    @include('common.alert', ['style' => "warning", 'content' => "Currently no developer has been added."] )
                                </div>
                            @else
                            {{-- Existen developers --}}

                                <div id="dev-list">
                                    <ul class="list-group">
                                        @foreach ($taskDevelopers as $developer)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10 my-auto data-item" data-id="{{$developer->id}}">
                                                    {{$developer->name}}, {{$developer->email}}
                                                </div>
                                                <div class="col-2">
                                                    <div class="float-right">
                                                        <a
                                                        data-id="{{$developer->id}}" data-funct="{{ route( 'f-ts-deldev', ['taskId' => $task->id, 'devId' => $developer->id ] ) }}"
                                                        href="" class="btn btn-circle icon-sm bg-dark text-white f-remove">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                            @endif

                        </div>

                        {{-- Añadir --}}
                        <div class="col-12 pb-2">
                            <h2>Add developers</h2>

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
                    <hr>

                    {{-- BOTON GUARDAR --}}
                    <div class="row">
                        <div class="col-12 text-center">
                            <button id="save" name="save" class="btn btn-success">Save</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection

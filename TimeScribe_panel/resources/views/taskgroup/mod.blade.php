@extends('layouts.app')


@section('head')
    <script src="/js/taskgroup/taskgroup_interface.js"></script>
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-10 mx-auto">
    <div class="card">
            <div class="card-header">
                <div class="row">

                    <div class="col-10 my-auto">
                        <h1 class="m-0">Edit task group</h1>
                    </div>

                    <div class="col-2 float-right my-auto">
                        <i class="far fa-id-card float-right">{{ $taskGroup->id }}</i>
                    </div>

                </div>
                
            </div>

            <div class="card-body m-4">

                <form method="post" action="{{ route('f-tg-mod', $taskGroup->id) }}">
                    @csrf

                    {{-- Datos del proyecto --}}
                    <div class="row pb-2">

                        <h2>Task group data</h2>

                        {{-- NOMBRE --}}
                        <div class="col-12">
                            <label class="control-label" for="name">Name:</label>
                            <div class="input-group mb-2">
                                    <input id="name" type="text" class="form-control" placeholder="Enter task group name" name="name" value="{{ $taskGroup->name }}" >
                            </div>
                        </div>

                        <!-- PROJECT DESCRIPTION -->
                        <div class="form-group col-12">
                            <label class="control-label" for="description">Description:</label>
                            <textarea id="description" class="form-control" rows="5" placeholder="Enter description" name="description">{{ $taskGroup->description }}</textarea>
                        </div>

                        <!-- VISIBILITY -->
                        <div class="col-12">
                            <label class="control-label" for="visible">Visibility status:</label>

                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="r1" name="visible" value="0" 
                                
                                @if ($taskGroup['visible'] == 0)
                                    checked                            
                                @endif

                                >
                                <label class="custom-control-label" for="r1">Not visible</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="r2" name="visible" value="1"
                                
                                @if ($taskGroup['visible'] == 1)
                                    checked                            
                                @endif
                                
                                >
                                <label class="custom-control-label" for="r2">Visible</label>
                            </div>
                        </div>
                        

           

                    </div>
                    <hr>

                    {{-- Configuracion de developers --}}
                    <div id="task-list" class="row pb-2">
                        <div class="col-12">
                            <h2>Task list</h2>
                        </div>

                        {{-- Lista de tareas --}}
                        <div id="" class="col-12 pb-2 mx-auto">

                            @if ($taskList == null)
                            {{-- Lista vacía --}}

                            <div id="dev-list-alert">
                                @include('common.alert', ['style' => "warning", 'content' => "Currently no task has been added."] )
                            </div>

                            @else
                            {{-- Lista --}}

                            <div class="pb-2">
                                <ul class="list-group">
                                    @foreach ($taskList as $task)
                                    <li class="list-group-item p-1 pl-4">
                                        <div class="row">

                                            {{-- NOMBRE --}}
                                            <div class="col-6 col-md-8 my-auto">
                                                {{$task->name}}
                                            </div>

                                            {{-- ELEMENTOS --}}

                                            <div class="col-6 col-md-4 my-auto">
                                                
                                                <div class="float-right pr-4">
                                                    {{-- EDITAR --}}
                                                    <a class="text-warning" 
                                                    href="{{route('v-ts-mod', ['taskId' => $task->id])}}" >
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    {{-- ELIMINAR --}}
                                                    <a class="text-warning f-remove" href
                                                    data-funct="{{route('f-ts-del', ['taskId' => $task->id])}}" >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>

                                                <div class="float-right pr-4">
                                                
                                                    {{$task->getStatusIcon()}}

                                                    {{$task->getVisibilityIcon()}}
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>    
                                    </li>


                                    @endforeach
                                </ul>
                            </div>

                            @endif

                        </div>
                        
                        <hr>
                        
                        <div class="col-12 ">
                            <div class="float-right">
                            <a href="{{route('v-ts-new', ['taskGroupId' => $taskGroup->id ])}}" id="addnewtask" class="btn btn-sm btn-primary ">Add new task</a>
                            </div>
                        </div>

                    </div>
                    <hr>
                    

                    {{-- BOTON GUARDAR --}}
                    <div class="row">
                        <div class="col-12 text-center">
                                <button id="save" name="save" class="btn btn-success ">Save</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection


@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src=""></script>
@endsection

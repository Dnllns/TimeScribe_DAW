@extends('layouts.app')


@section('head')
    <script src="/js/taskgroup/taskgroup_interface.js"></script>
@endsection

@section('content')


<div class="content">

    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
                <div class="card-header">
                    <strong>Edit task group</strong>
                    <i class="far fa-id-card float-right">{{ $taskGroup->id }}</i>
                </div>

                <div class="card-body m-4">

                    <form method="post" action="{{ route('f-tg-mod', $taskGroup->id) }}">
                        @csrf

                        {{-- Datos del proyecto --}}
                        <div class="row pb-2">

                            <p><strong>Task group data</strong></p>

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

                        </div>
                        <hr>

                        {{-- Configuracion de developers --}}
                        <div id="task-list" class="row pb-2">
                            <div class="col-12">
                                <p><strong>Task list</strong></p>
                            </div>

                            {{-- Lista de tareas --}}
                            <div id="" class="col-12 pb-4 mx-auto">

                                @if ($taskList == null)
                                {{-- Lista vacía --}}

                                <div id="dev-list-alert">
                                    @include('common.alert', ['style' => "warning", 'content' => "Currently no task has been added."] )
                                </div>

                                @else
                                {{-- Lista --}}

                                <div>
                                    <ul class="list-group">
                                        @foreach ($taskList as $task)
                                        <li class="list-group-item">
                                            <div class="row">

                                                {{-- NOMBRE --}}
                                                <div class="col-10">
                                                    {{$task->name}}
                                                </div>

                                                {{-- ELEMENTOS --}}
                                                <div class="col-1">

                                                    <div class="float-right">
                                                        {{$task->getVisibilityIcon()}}
                                                        {{$task->getStatusIcon()}}
                                                    </div>
                                                                                                        
                                                </div>

                                                <div class="col-1">

                                                    <div class="float-right">

                                                        {{-- EDITAR --}}
                                                        <a class="text-warning" 
                                                        href="{{route('v-ts-mod', ['taskId' => $task->id])}}" >
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        {{-- ELIMINAR --}}
                                                        <a class="text-danger f-remove" href
                                                        data-funct="{{route('f-ts-del', ['taskId' => $task->id])}}" >
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>

                                                    </div>
                                                    


                                                </div>

                                                
                                            <hr>
                                        </li>


                                        @endforeach
                                    </ul>
                                </div>

                                @endif

                            </div>

                        </div>

 
                        {{-- BOTON GUARDAR --}}
                        <div class="row">
                            <div class="col-12 ">
                                <div class="float-right">
                                    <button id="save" name="save" class="btn btn-success ">Save</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src=""></script>
@endsection

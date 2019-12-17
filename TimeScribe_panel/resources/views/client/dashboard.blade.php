@extends('layouts.app')

@section('content')



<div class="card">

    {{-- CARD HEADER --}}
    <div class="card-header text-uppercase">
        <div class="row">

            {{-- Titulo --}}
            <div class="col-12">
                <h1 class="my-auto">Client dashboard</h1>
            </div>



        </div>
    </div>


    {{-- CARD BODY --}}
    <div class="card-body m-4">


        {{-- LISTA DE PROYECTOS --}}
        <h2>Project list</h2>
        <ul class="list-group mt-2">

            @foreach ($clientProjects as $project)

            <li class="list-group-item">

                {{-- PROYECTO --}}
                <div id="project_{{$project->id}}" class="my-group">

                    {{-- CABECERA VISIBLE --}}
                    <div class="row">

                        {{-- Nombre Proyecto --}}
                        <div class="col-12 col-md-4 my-auto">
                            <h3 class="m-0 text-uppercase"><b>{{ $project->name }}</b></h3>
                        </div>

                        {{-- Barra de progreso --}}
                        <div class="col-10 col-md-6 my-auto">
                            {{-- <label for="pbar">Project % completed:</label> --}}
                            <div name="pbar" class="progress">
                                <div role="progressbar" aria-valuenow="{{$project->getPercentCompleted()}}"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-striped bg-success progress-bar-animated"
                                style="width: {{$project->getPercentCompleted()}}%;">{{$project->getPercentCompleted()}}%</div>
                            </div>
                        </div>

                        {{-- Boton de collapse --}}
                        <div class="col-2 col-md-2 my-auto">
                            <button type="button" class="btn btn-sm float-right" data-toggle="collapse" data-target="#projectcontent_{{$project->id}}">
                                <i class="fas fa-chevron-down text-info"></i>
                            </button>
                        </div>




                    </div>

                    {{-- CONTENIDO --}}
                    <div id="projectcontent_{{$project->id}}" class="collapse mt-4 p-2">

                        {{-- DESCRIPCION --}}
                        <div class="row">
                            <div class="col-12">

                                <h4 class="text-primary">Description:</h4>
                                <p name="description">{{ $project->description }}</p>

                            </div>
                        </div>

                        {{-- TRASKGROUPS --}}
                        <div class="row">

                            <div class="col-12">

                                <h4 class="text-primary">Task group list</h4>


                                @if ($project->taskgroups->count()==0)
                                @include('common.alert', ['style' => "warning", 'content' => "Currently no task group has been added."] )
                                @else

                                {{-- LISTA DE TASKGROUPS --}}
                                <ul class="list-group striped mt-3">



                                    @foreach ($project->taskgroups as $taskGroup)
                                    <li class="list-group-item">

                                        {{-- TASKGROUP ITEM --}}
                                        <div id="task_group_{{$taskGroup->id}}" >

                                            {{-- TASKGROUP HEADER --}}
                                            <div class="row">

                                                <div class="col-10 my-auto">
                                                    <p class="m-0 text-uppercase"><strong>{{$taskGroup->name}}</strong></p>
                                                </div>

                                                {{-- Boton de collapse --}}
                                                <div class="col-2 my-auto">
                                                    <button type="button" class="btn btn-sm float-right"
                                                    data-toggle="collapse" data-target="div[data-taskgroup-container='{{$taskGroup->id}}']">
                                                        <i class="fas fa-chevron-down text-info"></i>
                                                    </button>
                                                </div>

                                            </div>




                                            {{-- TASKGROUP CONTENT --}}
                                            <div data-taskgroup-container="{{$taskGroup->id}}" class="collapse mt-2">


                                                <p>Task list</p>
                                                {{-- TODO TASK --}}
                                                <div class="row my-2">

                                                    {{-- TODO --}}
                                                    <div class="col-10">
                                                        <p class="text-todo my-auto">


                                                            <span class="btn btn-circle icon-sm mb-1 todo" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Todo">
                                                                <strong class="text-dark">{{count($taskGroup->getTasks(0))}}</strong>
                                                            </span>
                                                            &nbsp;To do
                                                        </p>
                                                    </div>

                                                    {{-- Boton de collapse --}}
                                                    <div class="col-2 col-md-2 my-auto">

                                                        <button type="button" class="btn btn-sm float-right"
                                                        data-toggle="collapse" data-target="div[data-colapse='todo_{{$taskGroup->id}}']">
                                                            <i class="fas fa-chevron-down text-todo"></i>
                                                        </button>
                                                    </div>

                                                    {{-- TODO TASKS --}}
                                                    <div class="col-12 my-2 collapse" data-colapse="todo_{{$taskGroup->id}}">
                                                        <ul class="list-group mt-2">
                                                            @foreach ($taskGroup->getTasks(0) as $task)
                                                            <li class="list-group-item todo-list text-uppercase">
                                                                {{$task->name}}
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                </div>

                                                {{-- DOING TASK --}}
                                                <div class="row my-2">

                                                    {{-- DOING --}}
                                                    <div class="col-10">
                                                        <p class="text-doing my-auto">

                                                            <span class="btn btn-circle icon-sm mb-1 doing" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Doing">
                                                                <strong class="text-dark">{{count($taskGroup->getTasks(1))}}</strong>
                                                            </span>
                                                            &nbsp;Doing


                                                        </p>
                                                    </div>

                                                    {{-- Boton de collapse --}}
                                                    <div class="col-2 col-md-2 my-auto">
                                                        <button type="button" class="btn btn-sm float-right"
                                                        data-toggle="collapse" data-target="div[data-colapse='doing_{{$taskGroup->id}}']">
                                                            <i class="fas fa-chevron-down text-doing"></i>
                                                        </button>
                                                    </div>

                                                    {{-- DOING TASKS --}}
                                                    <div class="col-12 mb-2 collapse" data-colapse="doing_{{$taskGroup->id}}">
                                                        <ul class="list-group mt-2">
                                                            @foreach ($taskGroup->getTasks(1) as $task)
                                                            <li class="list-group-item doing-list">

                                                                <div class="row">

                                                                    {{-- NOMBRE TAREA --}}

                                                                    <div class="col-6 text-uppercase">
                                                                        {{$task->name}}
                                                                    </div>

                                                                    {{-- TIEMPO TRABAJADO --}}
                                                                    <div class="col-6">
                                                                        <div class="float-right">
                                                                            <strong>Worked time:</strong> {{$task->getWorkedTime()}}
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                </div>

                                                {{-- DONE TASK --}}
                                                <div class="row my-2">

                                                    {{-- DONE --}}
                                                    <div class="col-10">
                                                        <p class="text-done my-auto">
                                                            <span class="btn btn-circle icon-sm mb-1 done" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Done">
                                                                <strong class="text-dark">{{count($taskGroup->getTasks(2))}}</strong>
                                                            </span>
                                                            &nbsp;Done
                                                        </p>
                                                    </div>

                                                    {{-- Boton de collapse --}}
                                                    <div class="col-2 col-md-2 my-auto">
                                                        <button type="button" class="btn btn-sm float-right"
                                                        data-toggle="collapse" data-target="div[data-colapse='done_{{$taskGroup->id}}']">
                                                            <i class="fas fa-chevron-down text-done"></i>
                                                        </button>
                                                    </div>

                                                    {{-- DONE TASKS --}}
                                                    <div class="col-12 mb-2 collapse" data-colapse="done_{{$taskGroup->id}}">
                                                        <ul class="list-group mt-2">
                                                            @foreach ($taskGroup->getTasks(2) as $task)
                                                            <li class="list-group-item done-list">

                                                                <div class="row">

                                                                    {{-- NOMBRE TAREA --}}

                                                                    <div class="col-6 text-uppercase">
                                                                        {{$task->name}}
                                                                    </div>

                                                                    {{-- TIEMPO TRABAJADO --}}
                                                                    <div class="col-6">
                                                                        <div class="float-right">
                                                                            <strong>Worked time:</strong> {{$task->getWorkedTime()}}
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>


                                                </div>

                                            </div>

                                        </div>

                                    </li>
                                    @endforeach

                                </ul>

                                @endif

                            </div>

                        </div>




                    </div>

                </div>
            </li>

            @endforeach

        </ul>





    </div>


</div>


@endsection

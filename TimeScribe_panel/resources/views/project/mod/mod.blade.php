@extends('layouts.app')

@section('head')
    <script src="/js/project/mod/project_mod_functions.js"></script>
@endsection

@section('content')


<div class="content">

    <div class="row justify-content-center">
        <div class="col-md-8">
        <div id="project-container" data-projectid="{{$project->id}}" class="card">
                <div class="card-header">
                    <strong>Edit project</strong>
                    <i class="far fa-id-card float-right">{{ $project->id }}</i>
                </div>

                <div class="card-body m-4">

                    <form method="post" action="{{ route('f-pj-mod', $project->id) }}">
                        @csrf

                        {{-- Datos del proyecto --}}
                        <div class="row pb-2">

                            <p><strong>Project data</strong></p>

                            {{-- NOMBRE --}}
                            <div class="col-12">
                                <label class="control-label" for="name">Name:</label>
                                <div class="input-group mb-2">
                                        <input id="name" type="text" class="form-control" placeholder="Enter project name" name="name" value="{{ $project->name }}" >
                                </div>
                            </div>

                            <!-- PROJECT DESCRIPTION -->
                            <div class="form-group col-12">
                                <label class="control-label" for="description">Description:</label>
                                <textarea id="description" class="form-control" rows="5" placeholder="Enter description" name="description">{{ $project->description }}</textarea>
                            </div>

                        </div>
                        <hr>

                        {{-- Configuracion de developers --}}
                        <div id="dev-config-container" class="row pb-2">
                            <p><strong>Developers config</strong></p>

                            {{-- Lista de devs --}}
                            <div id="project-devs-container" class="col-12 pb-4">
                                <p>Developers list</p>

                                @if ($devList == null)
                                {{-- Lista vacía --}}

                                <div id="dev-list-alert">
                                    @include('common.alert', ['style' => "warning", 'content' => "Currently no developer has been added."] )
                                </div>

                                @else
                                {{-- Lista --}}

                                <div id="dev-list">
                                    <ul>
                                        @foreach ($devList as $dev)
                                        <li class="mb-1">
                                            <div class="row">
                                                <div data-id="{{$dev->id}}" class="col">{{$dev->name}}, {{$dev->email}}</div>
                                                <div class="col">
                                                    <a class="btn btn-sm text-danger f-remove" href
                                                    data-funct="{{route('f-pj-deldev', ['projectId' => $project->id, 'developerId' => $dev->id])}}" >
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
                                <p>Add developers</p>

                                {{-- Seleccionar dev perteneciente al Workgroup --}}
                                <div class="row">

                                    <div id="add-devs-container" class="col-12">


                                        @if ($workGroupDevs == null)
                                        {{-- Mensaje de alerta VACIO--}}

                                        <div id="add-devs-alert">
                                            @include('common.alert', ['style' => "warning", 'content' => "There isn't more developers availables"] )
                                        </div>


                                        @else
                                        {{-- Selecionar desarrollador --}}

                                        <div id="add-devs" class="col-12">
                                            <div class="row">

                                                <div class="col-6">
                                                    <p>Find developers in this workgroup:</p>

                                                    <select class="browser-default custom-select">
                                                    @foreach ( $workGroupDevs as $dev)
                                                    <option value="{{$dev->id}}"
                                                        data-funct={{route('f-pj-adddev', ["projectId"=> $project->id, "developerId" => $dev->id, "permissionType" => "permissionType" ] )}} >
                                                        {{$dev->name}}, {{$dev->email}}
                                                    </option>
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div id="permissions" class="col-6 mt-2">
                                                    <p>Permissions</p>
                                                    <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="r1" name="radio" value="{{$project::PERM_WORK}}" checked>
                                                        <label class="custom-control-label" for="r1">Work</label>
                                                    </div>

                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="r2" name="radio" value="{{$project::PERM_ALL}}">
                                                        <label class="custom-control-label" for="r2">All</label>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <a  class="btn btn-sm btn-primary float-right" href >Add selected</a>
                                                </div>

                                            </div>
                                        </div>

                                        @endif

                                    </div>
                                </div>

                            </div>

                        </div>
                        <hr>


                        {{-- Configuracion cliente --}}
                        <div class="row pb-2">
                            <p><strong>Client configuration</strong></p>
                            <div class="col-12 pb-4">



                                <div class="row">

                                    <!-- CLIENT EMAIL -->
                                    <div class="form-group col-6">
                                        <label class="control-label" for="client_email">Client email:</label>
                                        <input type="text" class="form-control" id="client_email" placeholder="Enter client email" name="client_email" value="{{ $client->email }}">
                                    </div>

                                    <!-- CLIENT NAME  -->
                                    <div class="form-group col-6">
                                        <label class="control-label" for="client_name">Client name:</label>
                                        <input type="text" class="form-control" id="client_name" placeholder="Enter client name" name="client_name" value="{{ $client->name }}">
                                    </div>


                                    <div class="col-12 my-auto">
                                        <a class="btn btn-primary btn-sm float-right" href=""> Resend the invitation</a>
                                    </div>

                                </div>



                            </div>

                        </div>

                        <hr>

                        {{-- Lista de grupos de tareas --}}
                        <div  class="row pb-2">
                            <p><strong>Task group configuration</strong></p>


                            <div id="taskgroup-list" class="col-12">

                                @if ( $taskGroups != null )

                                    <ul class="list-group">
                                        @foreach ($taskGroups as $taskGroup)
                                            <li class="list-group-item">
                                                @include('project.mod.partials.taskGroupItem', ['taskGroup' => $taskGroup])
                                            </li>

                                        @endforeach
                                    </ul>
                                @else
                                {{-- Mensaje de aviso, no hay tareas --}}

                                <div id="taskgroup-list-alert">
                                    @include('common.alert', ['style' => "warning", 'content' => "Currently no task group has been added."] )
                                </div>

                                @endif

                            </div>
                            <div class="col my-auto pt-3">
                                <a class="btn btn-sm btn-primary float-right" href="{{ route('v-tg-new', $project->id ) }}">Add new task group</a>
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

</div>

@endsection


@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src=""></script>
@endsection

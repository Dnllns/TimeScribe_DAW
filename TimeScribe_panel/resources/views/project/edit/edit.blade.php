@extends('layouts.app')

@section('content')


<div class="content">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Edit project</strong>
                    <i class="far fa-id-card float-right">{{ $project->id }}</i>
                </div>

                <div class="card-body m-4">

                    <form method="post" aaction="{{ route('f-pj-mod', $project->id) }}">
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
                        <div class="row pb-2">
                            <p><strong>Developers config</strong></p>

                            {{-- Lista de devs --}}
                            <div class="col-12 pb-4">
                                <p>Developers list</p>

                                @if ($devList == null)

                                    {{-- Lista vacía --}}
                                    @include('common.alert', ['style' => "warning", 'content' => "Currently no developer has been added."] )

                                @else
                                    {{-- Lista --}}
                                    <ul>
                                        @foreach ($devList as $dev)
                                            <li class="mb-1">
                                                <div class="row">
                                                    <div class="col">{{$dev->name}}, {{$dev->email}}</div>
                                                    <div class="col">
                                                        <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </div>

                            {{-- Añadir --}}
                            <div class="col-12 pb-4">
                                <p>Add developers</p>

                                {{-- Seleccionar dev perteneciente al Workgroup --}}
                                <div class="form-group col">
                                 
                                    <p>Find developers in this workgroup:</p>
                                    <div class="row"> 

                                        {{-- Selecionar desarrollador --}}
                                        <div class="col-6">
                                            <select class="browser-default custom-select">
                                                @foreach ( $workGroupDevs as $dev)
                                                    <option value="{{$dev->id}}">{{$dev->name}}, {{$dev->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col">
                                            <a href="" class="btn btn-primary">Add selected</a>
                                        </div>

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

                                </div>

                                

                            </div>

                        </div>

                        <hr>

                        {{-- Lista de grupos de tareas --}}
                        <div class="row pb-2">
                            <p><strong>Task group configuration</strong></p>

                            <div class="col-12">

                                @if ( $taskGroups != null )

                                    @foreach ($taskGroups as $taskGroup)

                                        @include('project.edit.partials.taskGroupItem', ['taskGroup' => $taskGroup])

                                        <hr style="color: #0056b2;" />

                                    @endforeach

                                @else

                                    {{-- Mensaje de aviso, no hay tareas --}}
                                    @include('common.alert', ['style' => "warning", 'content' => "Currently no task group has been added."] )

                                @endif


                                <br>
                                <a class="btn btn-primary" href="{{ route('v-tg-new', $project->id ) }}">Add new task group</a>

                            </div>
                        </div>


                        {{-- BOTON GUARDAR --}}
                        <div class="row">
                            <div class="col-12">
                                <button id="save" name="save" class="btn btn-primary float-right">Save</button>
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

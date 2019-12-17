@extends('layouts.app')

@section('head')
    <script src="/js/project/mod/developers_configuration_functions.js"></script>
    <script src="/js/project/mod/tg_configuration_functions.js"></script>
    <script src="/js/project/mod/invite_client.js"></script>
    <script src="/js/project/mod/delete_client.js"></script>
    <script src="/js/project/mod/client_invitation_list_functions.js"></script>



@endsection

@section('content')

<div class="row">
    <div class="col-12 col-lg-10 mx-auto">
        <div id="project-container" data-projectid="{{$project->id}}" class="card">

            <div class="card-header">
                @include(
                    'common.card-header-content',
                    [
                        'title' => "Edit project",
                        'breadCrumbs' => $project->getBreadCrumbs(),
                        'id' => $project->id
                    ]
                )
            </div>
            <div class="card-body m-4">

                <form method="post" action="{{ route('f-pj-mod', $project->id) }}">
                    @csrf

                    {{-- Datos del proyecto --}}
                    <div class="row pb-2">

                        <h2 class="text-primary">Project data</h2>

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

                    {{-- Configuracion de developers --}}


                    <div id="dev-config-container" class="row pb-2">

                        <h2 class="text-primary">Developers configuration</h2>


                        {{-- Lista de devs --}}

                        <div id="project-devs-container" class="col-12 pl-0 pb-2">
                            <h3>Developers list</h3>

                            @if ($devList == null)
                            {{-- Lista vacía --}}

                            <div id="dev-list-alert">
                                @include('common.alert', ['style' => "warning", 'content' => "Currently no developer has been added."] )
                            </div>

                            @else
                            {{-- Lista --}}

                            <div id="dev-list" class="col-12 pt-2">
                                <ul class="list-group ">
                                    @foreach ($devList as $dev)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div data-content data-id="{{$dev->id}}" class="col my-auto">{{$dev->name}}, {{$dev->email}}</div>
                                            <div class="col-auto my-auto">
                                                <div class="float-right">

                                                    @if($project->getPermission($dev->id) == $project::PERM_WORK)

                                                    <span class="btn btn-circle btn-sm bg-secondary">
                                                        <i class="fas fa-user-cog text-white" data-toggle="tooltip" data-placement="right" title="Working permissions"></i>
                                                    </span>


                                                    @elseif($project->getPermission($dev->id) == $project::PERM_ALL)

                                                    <span class="btn btn-circle btn-sm bg-secondary">
                                                        <i class="fas fa-user-shield text-white" data-toggle="tooltip" data-placement="right" title="Working permissions"></i>
                                                    </span>


                                                    @endif



                                                    @if( $dev->is_admin != 1)

                                                    &nbsp;



                                                    <a class="btn btn-circle btn-sm bg-dark text-white f-remove" href
                                                    data-funct="{{route('f-pj-deldev', ['projectId' => $project->id, 'developerId' => $dev->id])}}" >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                    @endif
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

                        <div class="col-12 pl-0 pt-2 pb-4">
                            <h3>Add developers</h3>

                            {{-- Seleccionar dev perteneciente al Workgroup --}}
                            <div class="row">

                                <div id="add-devs-container" class="col-12">


                                    @if ($workGroupDevs == null)
                                    {{-- Mensaje de alerta VACIO--}}

                                    <div id="add-devs-alert" class="pt-2">
                                        @include('common.alert', ['style' => "warning", 'content' => "There isn't more developers availables"] )
                                    </div>


                                    @else
                                    {{-- Selecionar desarrollador --}}

                                    <div id="add-devs" class="col-12 pt-2">
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

                                            <div id="permissions" class="col-6">
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


                                            <div class="col-12 pt-4">
                                                <a  class="btn btn-sm btn-primary float-right" href >Add selected</a>
                                            </div>

                                        </div>
                                    </div>

                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- Configuracion cliente --}}
                    <div class="row pb-2">
                        <h2 class="text-primary">Client configuration</h2>

                        <div class="col-12 pl-0 pb-4">

                            <div class="row p-2">

                                <div id="addclient-alert" class="col-12">
                                </div>

                                {{-- Cliente establecido --}}

                                    <div id="current-client" class="col-12">


                                        @if($project->client_id != null)

                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col">
                                                        {{$project->getClient()->name}}, {{$project->getClient()->email}}
                                                    </div>
                                                    <div class="col-1 text-right">
                                                        <a class="btn btn-circle btn-sm bg-dark text-white" href="" data-projectid={{$project->id}} data-clientid={{$project->getClient()->id}} >
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        @endif

                                    </div>



                                    @php

                                        $hasInvitation = false;
                                        $displayInvitationList = "d-none";
                                        $displayInvitationContainer = "";
                                        $invitation = $project->getClientInvitation();

                                        if($invitation!=null && $invitation->count() > 0 ){
                                            if($invitation->used != 1){
                                                $hasInvitation = true;
                                                $displayInvitationList = "";
                                                $displayInvitationContainer = "d-none";
                                            }
                                        }

                                    @endphp



                                    {{-- Establecer cliente --}}
                                    <div id="send-invitation-container" class="col-12 {{$displayInvitationContainer}}">

                                        @if($project->client_id == null)

                                        <h3>Add client</h3>


                                        <div class="row">

                                            <!-- CLIENT NAME  -->
                                            <div class="form-group col-12 mb-0 col-md-6">
                                                <label class="control-label" for="client_name">Client name:</label>
                                                <input type="text" class="form-control" id="client_name" placeholder="Enter client name" name="client_name" value="@if($client != null){{$client->name }}@endif">
                                            </div>

                                            <!-- CLIENT EMAIL -->
                                            <div class="form-group col-12  mb-0 col-md-6">
                                                <label class="control-label" for="client_email">Client email:</label>
                                                <input type="text" class="form-control" id="client_email" placeholder="Enter client email" name="client_email" value="@if($client != null){{$client->email }}@endif">
                                            </div>


                                            <div class="col-12 pt-4 my-auto">
                                                <a id="send-invitation" class="btn btn-primary btn-sm float-right" href=""> Send the invitation</a>
                                            </div>

                                            {{-- Datos necesarios en javascript --}}
                                            <script>
                                                var adminName = {!! json_encode(Auth::user()->name, JSON_HEX_TAG) !!}
                                                var projectName = {!! json_encode($project->name, JSON_HEX_TAG) !!}
                                                var projectId = {!! json_encode($project->id, JSON_HEX_TAG) !!}
                                            </script>

                                        </div>

                                        @endif

                                    </div>




                                    <div id="client-invitation-list" class="col-12 mt-2 {{$displayInvitationList}} ">
                                        <h3>Client invitation</h3>

                                        @if($hasInvitation)

                                        <ul class="list-group">
                                            <li class="list-group-item" data-invitationid="9" >
                                                <div class="row">
                                                    <div class="col-10">{{$invitation['email']}}</div>
                                                    <div class="col">
                                                        <div class="float-right">
                                                            <a href="" class="btn btn-circle btn-sm bg-dark text-white" data-remove-invitation  data-invitationid="{{$invitation->id}}">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        @endif
                                    </div>


                            </div>

                        </div>

                    </div>

                    {{-- Lista de grupos de tareas --}}
                    <div  class="row pb-2">
                        <h2 class="text-primary">Task group configuration</h2>


                        <div id="taskgroup-list" class="col-12 px-0">
                            <h3>Task group list</h3>

                            @php
                                $showDeleteds = false;
                                if(Auth::user()->is_admin == 1){
                                    $showDeleteds = true;
                                }
                            @endphp

                            {{-- Si el ususario es administrador mostrar eliminados --}}
                            <script>
                                var showDeleteds =  {!! json_encode($showDeleteds, JSON_HEX_TAG) !!}
                            </script>


                            @if ( $taskGroups != null )
                                <div class="col-12">
                                    <ul class="list-group">
                                        @foreach ($taskGroups as $taskGroup)
                                            <li class="list-group-item">
                                                @include('project.mod.taskGroupItem', ['taskGroup' => $taskGroup])
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            @else
                            {{-- Mensaje de aviso, no hay tareas --}}

                            <div id="taskgroup-list-alert">
                                @include('common.alert', ['style' => "warning", 'content' => "Currently no task group has been added."] )
                            </div>

                            @endif

                        </div>
                        <div class="col my-auto pt-4">
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


@endsection


@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src=""></script>
@endsection

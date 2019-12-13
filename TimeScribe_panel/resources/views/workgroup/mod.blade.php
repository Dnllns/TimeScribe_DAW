@extends('layouts.app')


@section('head')
    <script src="/js/workgroup/workgroup_mod_interface.js"></script>
    <script src="/js/workgroup/invitationEmail/sendInvitationEmail.js"></script>

@endsection

@section('content')


{{-- Alert message for when new workgroup is created --}}
@if ($isNew)

    @php
        $content =  "Hey " . auth()->user()->name . "!" . "<br>".
        "The workgroup <strong>" . $workGroup->name . "</strong> has been successfully created. Now you can start creating a new project."
    @endphp

    @include('common.alert', ['style' => "success", 'content' => $content] )

@endif

<div class="row">
    <div class="col-10 mx-auto">
        <div class="card">

            {{-- CABECERA --}}


            <div class="card-header">

                <div class="row">
                    <div class="col-12 col-md-6">
                        <h1 class="my-auto text-uppercase">Edit workgroup</h1>

                    </div>

                    <div class="col-auto col-md-5 my-auto text-uppercase">
                        <div class="float-right ">
                            <a class="text-info" href="{{route('v-wg-show', $workGroup->id )}}">
                                {{$workGroup->name}}
                            </a>
                        </div>
                    </div>

                    <div class="col-auto col-md-1 my-auto">
                        <div class="float-right">
                            <i class="far fa-id-card">{{$workGroup->id}}</i>
                        </div>
                    </div>
                </div>

            </div>

            {{-- CONTENIDO --}}
            <div class="card-body m-4">

                <form method="post" action="{{ route('f-wg-mod', ['workGroupId'=>$workGroup->id]) }}">
                    @csrf


                    {{-- NOMBRE --}}
                    <div class="row pb-2">
                        <div class="col-12">
                            <h2>Workgroup data</h2>

                            <label class="control-label" for="name">Name:</label>
                            <div class="input-group mb-2">
                                <input id="name" name="name" type="text" placeholder="My workgroup"  value="{{$workGroup->name}}" class="form-control input-md">
                            </div>
                        </div>
                    </div>


                    {{-- AÑADIR USUARIOS --}}
                    <div class="row py-2">

                        <h2>Developers configuration</h2>

                        {{-- Lista de usuarios --}}
                        <div id="dev-list" class="col-12 pt-2 pb-4">
                            <h3>Developer list</h3>

                            @if (!isset($workGroupDevelopers))

                                {{-- Sin developers asignados --}}
                                @include('common.alert', ['style' => "warning", 'content' => "Currently no developer has been added."] )

                            @else

                                {{-- Existen developers --}}
                                <ul class="list-group py-2">
                                    @foreach ($workGroupDevelopers as $developer)

                                        <li class="list-group-item px-4 py-2 ">
                                            <div class="row">
                                                <div class="col-10">{{$developer->name}}, {{$developer->email}}</div>
                                                <div class="col-2">
                                                    <div class="float-right">

                                                        {{-- controlar no eliminar al admin --}}
                                                        @if( Auth::user()->is_admin != 1)


                                                        <a href=""  class="btn btn-circle btn-sm bg-dark"
                                                        data-tooltip="tooltip" data-placement="bottom" data-original-title="Remove"
                                                        data-funct="{{route('f-wg-removedev', ['userId' => $developer->id])}}">
                                                            <i class="fas fa-trash-alt text-white"></i>
                                                        </a>

                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    @endforeach
                                </ul>

                            @endif

                        </div>

                        {{-- Añadir --}}
                        <div id="add-developers" class="col-12 pt-2 pb-4">
                            <h3>Add developers</h3>

                            <div class="row">

                                <div class="col-6">

                                    {{-- Nombre --}}
                                    <label class="control-label" for="name">Name:</label>
                                    <div class="input-group mb-2">
                                        <input name="adddev-name" type="text" placeholder="Developer name" class="form-control input-md">
                                    </div>

                                </div>

                                <div class="col-6">

                                    {{-- Email --}}
                                    <label class="control-label" for="email">Email:</label>
                                    <div class="input-group mb-2">
                                        <input name="addev-email" type="email" placeholder="Developer email" class="form-control input-md">
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="float-right">
                                        <a id="add-developers-btn" href="" class="btn btn-primary btn-sm mt-2">
                                            <span><i class="far fa-envelope"></i></span>&nbsp;
                                            Send invitation
                                        </a>
                                    </div>
                                    {{-- Datos necesarios en javascript --}}
                                    <script>
                                        var adminName = {!! json_encode(Auth::user()->name, JSON_HEX_TAG) !!}
                                        var workgroupName = {!! json_encode($workGroup->name, JSON_HEX_TAG) !!}
                                        var workgroupId = {!! json_encode($workGroup->id, JSON_HEX_TAG) !!}
                                    </script>
                                </div>

                            </div>

                        </div>

                        {{-- Invitaciones pendientes --}}
                        <div id="invitations" class="col-12 pb-4">
                            <h3 class="mb-4">Pending invitations</h3>

                            @if ($workGroupInvitations == null)
                            {{-- Mensaje de alerta de sin invitaciones --}}

                            <div id="invitation-alert">
                                @include('common.alert', ['style' => "warning", 'content' => "Currently no invitation is pending."] )
                            </div>

                            @else
                            {{-- Lista de invitaciones --}}

                            <div id="invitation-list">

                                <ul class="list-group">
                                    @foreach ($workGroupInvitations as $invitation)
                                    <li class="list-group-item" data-invitationid="{{$invitation->id}}">
                                        <div class="row">
                                            <div class="col-10">{{$invitation->email}}</div>
                                            <div class="col">
                                                <div class="float-right">
                                                    <a href class="btn btn-circle btn-sm bg-dark text-white" data-remove-invitation
                                                    data-tooltip="tooltip" data-placement="bottom" data-original-title="Remove"
                                                    data-funct="{{route('f-wg-removeinvitation', [$invitation->id])}}">
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

                    </div>



                    <hr>

                    {{-- BOTON GUARDAR --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <button id="save" name="save" class="btn btn-success ">Save</button>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection

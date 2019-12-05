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

                    <div class="col-6">
                        <h1 class="my-auto">Edit workgroup</h1>
                    </div>

                    <div class="col-6 my-auto">
                        <div class="float-right">
                            {{$workGroup->name}} <i class="far fa-id-card">{{$workGroup->id}}</i>
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

                    <hr>

                    {{-- AÑADIR USUARIOS --}}
                    <div class="row pb-2">


                        {{-- Lista de usuarios --}}
                        <div id="dev-list" class="col-12 pb-4">
                            <h2>Developer list</h2>


                            @if (!isset($workGroupDevelopers))
                            {{-- Sin developers asignados --}}

                                @include('common.alert', ['style' => "warning", 'content' => "Currently no developer has been added."] )

                            @else
                            {{-- Existen developers --}}

                                <ul class="list-group">
                                    @foreach ($workGroupDevelopers as $developer)

                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-10">{{$developer->name}}, {{$developer->email}}</div>
                                                <div class="col-2">
                                                    <div class="float-right">
                                                        <a href=""  class="text-warning f-remove"
                                                        data-funct="{{route('f-wg-removedev', ['userId' => $developer->id])}}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    @endforeach
                                </ul>

                            @endif



                        </div>

                        {{-- Añadir --}}
                        <div id="add-developers" class="col-12 pb-4">
                            <h2>Add developers</h2>




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
                                        <a id="add-developers-btn" href="" class="btn btn-primary btn-sm mt-2">Enviar invitacion</a>
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
                            <h2>Pending invitations</h2>

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
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10">{{$invitation->email}}</div>
                                            <div class="col">
                                                <div class="float-right">
                                                    <a href="" class="text-warning">
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

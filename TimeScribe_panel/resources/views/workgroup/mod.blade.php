@extends('layouts.app')


@section('head')
    <script src="/js/workgroup/workgroup_mod_interface.js"></script>
@endsection

@section('content')
<div class="container">


    {{-- Alert message for when new workgroup is created --}}
    @if ($isNew)
    <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
        Hey {{auth()->user()->name}}!
        <br>
        The workgroup <strong>{{$workGroup->name}}</strong> has been successfully created. Now you can start creating a new project.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Edit workgroup</strong></div>

                <div class="card-body m-4">




                    <form method="post" action="{{ route('f-wg-mod', ['workGroupId'=>$workGroup->id]) }}">
                        @csrf


                        {{-- NOMBRE --}}
                        <div class="row pb-2">
                            <div class="col-12">
                                <p><strong>Workgroup data</strong></p>



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
                                <p><strong>Developer list</strong></p>


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
                                                            <a href=""  class="text-danger f-remove"
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
                                <p><strong>Add developers</strong></p>

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
                                    </div>

                                </div>
                                

                                

                            </div>

                            {{-- Invitaciones pendientes --}}
                            <div id="invitations" class="col-12 pb-4">
                                <p><strong>Pending invitations</strong></p>

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
                                                        <a href="" class="text-danger">
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

                        {{-- BOTON GUARDAR --}}
                        <div class="row">
                            <div class="col-12">
                                <button id="save" name="save" class="btn btn-success float-right">Save</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

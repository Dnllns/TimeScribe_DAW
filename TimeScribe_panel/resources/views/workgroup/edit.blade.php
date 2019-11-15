@extends('layouts.app')

@section('content')
<div class="container">


    {{-- Alert message for when new workgroup is created --}}
    @if ($isNew)
        <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
            Hey {{auth()->user()->name}}!
            <br>
            The workgroup <strong>{{$workGroup->name}}</strong> has been successfully created.
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


                    

                    <form method="post" action="{{ route('workgroup-f-edit', ['workGroupId'=>$workGroup->id]) }}">
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
                            
                            <div class="col-12 pb-4">
                                <p><strong>Developer list</strong></p>

                                <ul>
                                    @foreach ($workGroupDevelopers as $developer)

                                        <li>
                                            <div class="row">
                                                <div class="col">{{$developer->name}}, {{$developer->email}}</div>
                                                <div class="col">
                                                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                            
                                    @endforeach
                                </ul>

                            </div>

                            {{-- Añadir --}}
                            <div class="col-12 pb-4">
                                <p><strong>Add developers</strong></p>

                                {{-- Nombre --}}
                                <label class="control-label" for="name">Name:</label>
                                <div class="input-group mb-2">
                                    <input id="name" name="name" type="text" placeholder="Developer name" class="form-control input-md">
                                </div>

                                {{-- Email --}}
                                <label class="control-label" for="email">Email:</label>
                                <div class="input-group mb-2">
                                    <input id="email" name="email" type="email" placeholder="Developer email" class="form-control input-md">
                                </div>

                                <a href="" class="btn btn-warning mt-2">Enviar invitacion</a>
    
                            </div>

                            {{-- Invitaciones pendientes --}}
                            <div class="col-12 pb-4">
                                <p><strong>Pending invitations</strong></p>
                                <ul>
                                    @foreach ($workGroupInvitations as $invitation)


                                        <li>
                                            <div class="row">
                                                <div class="col">{{$invitation->email}}</div>
                                                <div class="col">
                                                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        
                                    @endforeach

                                </ul>
                                
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

@extends('layouts.app')

@section('content')
<div class="container">


    {{-- Alert message for when new task is created --}}
    @if ($isNew)
    @include(
        'common.alert',
        [
            'style' => "sucsess",
            'content' => "The task <strong>{{$task->name}}</strong> has been successfully created."
        ]
    )
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Edit task</strong></div>

                <div class="card-body m-4">


                    <form method="post" action="{{ route('f-ts-mod', ['taskId'=>$task->id]) }}">
                        @csrf


                        {{-- Datos de la tarea --}}
                        <div class="row pb-2">

                            <p><strong>Task data</strong></p>

                            <div class="col-12">
                                <label class="control-label" for="name">Name:</label>
                                <div class="input-group mb-2">
                                    <input id="name" name="name" type="text" placeholder="My workgroup"  value="{{$task->name}}" class="form-control input-md">
                                </div>
                            </div>

                            <!-- PROJECT DESCRIPTION -->
                            <div class="form-group col-12">
                                <label class="control-label" for="description">Description:</label>
                                <textarea id="description" class="form-control" rows="5" placeholder="Enter description" name="description">{{ $project->description }}</textarea>
                            </div>

                        </div>

                        <hr>

                        {{-- AÑADIR USUARIOS --}}
                        <div class="row pb-2">


                            {{-- Lista de usuarios --}}
                            <div class="col-12 pb-4">
                                <p><strong>Developer list</strong></p>


                                @if (!isset($workGroupDevelopers))
                                {{-- Sin developers asignados --}}

                                    @include('common.alert', ['style' => "warning", 'content' => "Currently no developer has been added."] )

                                @else
                                {{-- Existen developers --}}

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

                                @endif

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

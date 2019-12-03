@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-12 col-md-10 mx-auto">
        <div class="card">

                <div class="card-header">
                    <div class="row">

                        <div class="col-10 my-auto">
                            <h1 class="m-0">New task</h1>
                        </div>

                        {{-- <div class="col-2 float-right my-auto">
                            <i class="far fa-id-card float-right">{{ $taskGroup->id }}</i>
                        </div> --}}

                    </div>
                    
                </div>


            <div class="card-body m-4">

                <form method="post" action="{{ route('f-ts-new', $taskGroupId) }}">
                    @csrf


                    {{-- Datos de la tarea --}}
                    <div class="row pb-2">

                        <h2>Task data</h2>

                        <div class="col-12">
                            <label class="control-label" for="name">Name:</label>
                            <div class="input-group mb-2">
                                <input id="name" name="name" type="text" placeholder="Enter task name"  value="" class="form-control input-md">
                            </div>
                        </div>

                        <!-- TASK DESCRIPTION -->
                        <div class="form-group col-12">
                            <label class="control-label" for="description">Description:</label>
                            <textarea id="description" class="form-control" rows="5" placeholder="Enter description" name="description"></textarea>
                        </div>

                    </div>

                    <hr>

                    {{-- BOTON GUARDAR --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <button id="save" name="save" class="btn btn-success">Save</button>
                            </div>
                            
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

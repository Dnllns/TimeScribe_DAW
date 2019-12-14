@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-12 col-lg-10 mx-auto">
        <div class="card">

                <div class="card-header">
                    @include(
                        'common.card-header-content',
                        [
                            'title' => "Create task",
                            'breadCrumbs' => $taskGroup->getBreadCrumbs()
                        ]
                    )
                </div>


            <div class="card-body m-4">

                <form method="post" action="{{ route('f-ts-new', $taskGroup->id) }}">
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
                            <textarea id="description" class="form-control" rows="3" placeholder="Enter description" name="description"></textarea>
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

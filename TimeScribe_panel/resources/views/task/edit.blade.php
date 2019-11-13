@extends('layouts.app')

@section('content')



<div class="container">

    <h2>Create task</h2>

    <form class="form-horizontal" method="post" action="{{ route('rt_ts_update', $task->id) }}">

        @csrf <!-- {{ csrf_field() }} -->

        <div class="row">
            <label class="control-label" for="name">Task name:</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="name" placeholder="Enter task name" name="name" value="{{$task->name}}">
            </div>
        </div>
        
        
        <div class="row">
            <label class="control-label" for="description">Description:</label>
            <div class="input-group mb-2">
                <textarea class="form-control" id="description" rows="3"placeholder="Enter description">{{$task->description}}</textarea>
            </div>
        </div>
        
        
        {{-- Desarrolladores asignados --}}
        <div class="row">
            <label class="control-label" for="asignedDevs">Asigned developers:</label>
            <div id="asignedDevs" class="input-group">
                @foreach ( $task->getDevelopers() as $developer )
                    <div>
                        {{$developer->name}}, {{$developer->email}}, {{$developer->id}} 
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Añadir desdarrolladores del Workgroup -->
        <div class="row">

            
            <label class="control-label" for="adddev">Add developer *(Must be in te WorkGroup)</label>
            <div class="input-group">

                {{-- Selector --}}
                <div class="col col-md-5 p-0">
                    <select id="adddev" class="form-control">

                        @foreach ( $workGroupDevelopers as $developer )
                            <option value="{{$developer->id}}">{{$developer->name}}, {{$developer->email}}</option>
                        @endforeach
                        
                    </select>
                </div>

                {{-- Boton de añadir --}}
                <div class="col">
                    <button type="button" class="btn btn-primary"> Añadir </button>
                </div>

            </div>           


        </div>
        


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>

    </form>


</div>




@endsection

@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src=""></script>
@endsection

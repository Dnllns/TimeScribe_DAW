@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <h1>Edit task group</h1>

        <h2>TaskGroup Id {{ $taskGroup->id }}</h2>


        <form class="form-horizontal" method="post" action="{{route('f-tg-mod', $taskGroup->id)}}">

            @csrf <!-- {{ csrf_field() }} -->


            <!-- PROJECT NAME  -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Task group name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter task group name" name="name"
                    value="{{ $taskGroup->name }}" >
                </div>
            </div>


            <!-- PROJECT DESCRIPTION -->
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="description" placeholder="Enter description" name="description"
                    value="{{ $taskGroup->description }}">
                </div>
            </div>

            <br>


            <!-- TASK PANEL -->
            <fieldset class="border p-2">
                <legend  class="w-auto">Task list</legend>

                @if ( $taskList != null )

                    @foreach ($taskList as $task)

                        <div class="d-flex ">
                            <div class="col-sm-6">
                                <ul>
                                    <li><h3>{{ $task->name }}</h3></li>
                                    <li>{{ $task->description }}</li>
                                    <li>Status: {{ $task->status }}</li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <a class="btn btn-primary" href="{{ route('v-ts-mod', $task->id) }}" >Edit</a>
                                <a class="btn btn-primary" href="{{ route('f-ts-del', $task->id) }}" onclick="return confirm('Are you sure?')">Delete</a>
                            </div>

                        </div>

                        <hr style="color: #0056b2;" />

                    @endforeach

                @else

                    @include('common.alert', ['style' => "warning", 'content' => "Currently no task has been added."] )

                @endif

                <br>
                <a class="btn btn-primary" href="{{ route('v-ts-new', $taskGroup->id)}}">Add new task</a>
                <br>


            </fieldset>

            <br>

            <!-- SAVE BUTTON -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Save changes</button>
                </div>
            </div>

        </form>

    </div>

</div>

@endsection


@section('js_libs')
    <!-- JS LIBRARYS -->
    <script src=""></script>
@endsection

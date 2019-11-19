@extends('layouts.app')

@section('content')

<div class="content">


    <div class="container">

        <h2>Create task</h2>

        <form class="form-horizontal" method="post" action="{{ route('f-ts-new', $taskGroupId) }}">

            @csrf <!-- {{ csrf_field() }} -->


            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Task name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter task name" name="name">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="description" placeholder="Enter description" name="description">
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
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

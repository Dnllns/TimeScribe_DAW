@extends('layouts.app')

@section('content')

    <div class="content">

        <!-- CREATE PROJECT FORM -->

        <div class="container">

            <h2>Create new project</h2>

            <form class="form-horizontal" method="post" action="{{ route('rt_pr_register') }}">

                @csrf <!-- {{ csrf_field() }} -->


                <!-- PROJECT NAME  -->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Project name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Enter project name" name="name">
                    </div>
                </div>

                <!-- PROJECT DESCRIPTION -->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="description">Description:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" placeholder="Enter description" name="description">
                    </div>
                </div>

                <!-- SELECT CLIENT -->
                <div class="form-group">
                    <label class="control-label col-sm-2" for="client_id">Client id:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="client_id" placeholder="Enter client id" name="client_id">
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

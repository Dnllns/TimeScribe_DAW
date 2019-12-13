@extends('layouts.app')

@section('content')


<!-- CREATE PROJECT FORM -->

<div class="row">
    <div class="col-12 col-md-12 mx-auto">
        <div class="card">


            <div class="card-header">
                @include(
                    'common.card-header-content',
                    [
                        'title' => "Create project",
                        'breadCrumbs' =>$workGroup->getBreadCrumbs(),
                        'id' => ""
                    ]
                )


            </div>

            <div class="card-body m-4">

                <form class="form-horizontal" method="post" action="{{ route('f-pj-new', ['workGroupId'=>$workGroup->id]) }}">
                    @csrf
                    <div class="row">

                        <div class="col-12">

                            <h2>Project data</h2>

                            <!-- PROJECT NAME  -->

                            <div class="form-group col-12 col-md-6">
                                <label class="control-label" for="name">Project name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter project name" name="name">
                            </div>

                            <!-- PROJECT DESCRIPTION -->
                            <div class="form-group col-12">
                                <label class="control-label" for="description">Description:</label>
                                <textarea type="text" class="form-control" id="description" placeholder="Enter description" name="description" rows="4"></textarea>
                            </div>

                            <h2>Add client</h2>
                            <div>
                                <div class="row">

                                    <div class="col-12">
                                        <h3>New client</h3>
                                    </div>


                                    <!-- CLIENT NAME  -->
                                    <div class="form-group col-12 pt-3 mb-0 col-md-6">
                                        <label class="control-label" for="client_name">Client name:</label>
                                        <input type="text" class="form-control" id="client_name" placeholder="Enter client name" name="client_name" value>
                                    </div>

                                    <!-- CLIENT EMAIL -->
                                    <div class="form-group col-12 pt-3 mb-0 col-md-6 ">
                                        <label class="control-label" for="client_email">Client email:</label>
                                        <input type="text" class="form-control" id="client_email" placeholder="Enter client email" name="client_email" value>
                                    </div>


                                    <div class="col-12 pt-4 my-auto">
                                        <a id="send-invitation" class="btn btn-primary btn-sm float-right" href=""> Send the invitation</a>
                                    </div>

                                    {{-- Datos necesarios en javascript --}}
                                    {{-- <script>
                                        var adminName = {!! json_encode(Auth::user()->name, JSON_HEX_TAG) !!}
                                        var projectName = {!! json_encode($project->name, JSON_HEX_TAG) !!}
                                        var projectId = {!! json_encode($project->id, JSON_HEX_TAG) !!}
                                    </script> --}}

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h3>Old clients</h3>
                                    </div>

                                    @php
                                    $clients= $workGroup->getAllClients();
                                    $content = "There isn't old clients";
                                    @endphp

                                    @if ($clients->count()==0)
                                        <div class="col-12">
                                            @include('common.alert', ['style' => "warning", 'content' => $content] )
                                        </div>


                                    @else
                                        <div class="col-6">
                                            <select class="browser-default custom-select">
                                                <option default value="">Select</option>
                                                @foreach ($clients as $client)
                                                <option value="{{$client->id}}"> {{$client->name}} {{$client->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <hr>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>







@endsection

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


                        <!-- Text input-->
                        

                        <div class="row">
                            <div class="col-12">
                                <label class="control-label" for="name">Name:</label>
                                <div class="input-group mb-2">
                                    <input id="name" name="name" type="text" placeholder="My workgroup"  value="{{$workGroup->name}}" class="form-control input-md">
                                </div>
                            </div>
                        </div>

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

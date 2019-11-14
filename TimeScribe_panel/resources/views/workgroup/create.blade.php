@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Create workgroup</strong></div>

                <div class="card-body m-4">
                    

                    <form method="post" action="{{ route('workgroup-f-create') }}">
                        @csrf

                        <div class="row">
                            <p>The work group is the space where your company's projects will be located</p>
                        </div>

                        <!-- Text input-->
                        

                        <div class="row">
                            <div class="col-12">
                                <label class="control-label" for="name">Name:</label>
                                <div class="input-group mb-2">
                                    <input id="name" name="name" type="text" placeholder="My workgroup" class="form-control input-md">
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="m-0 text-uppercase">Create workgroup</h1>
                </div>

                <div class="card-body m-4">

                    <form method="post" action="{{route('f-wg-new')}}">
                        @csrf

                        <div class="row">

                            <div class="col-12">
                                @php
                                $content = "The work group is the space where your projects will be located";
                                @endphp
                                @include('common.alert', ['style' => "info", 'content' => $content] )
                            </div>

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

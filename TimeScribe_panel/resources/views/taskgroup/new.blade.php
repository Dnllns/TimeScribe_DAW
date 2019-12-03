@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h1 class="m-0" >Create task group</h1>
            </div>

            <div class="card-body m-4">

                <form class="form-horizontal" method="post" action="{{ route('f-tg-new', $projectId) }}">

                    @csrf <!-- {{ csrf_field() }} -->

                    <div class="row">


                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label" for="name">TaskGroup name:</label>
                                <div class="">
                                    <input type="text" class="form-control" id="name" placeholder="Enter task group name" name="name">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label" for="description">Description:</label>
                                <div class="">
                                    <textarea 
                                    class="form-control rounded-1" rows="3" placeholder="Enter task group description"
                                    id="description" name="description" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-12"><hr></div>
            
                        
            
                        <div class="col-12 mt-2">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Save</button>
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

<div data-{{$status}} class="col-12 m-0 mb-1 p-1 col-lg-4">

    {{-- HEADER --}}
    <div class="row m-0 p-1 rounded bg-{{$status}}">

        {{-- TITULO --}}
        <div class="col-10  my-auto col-lg-12" >
            <h4 class="text-left text-dark m-0 p-0 text-lg-center text-uppercase ">
                {{$status}}
            </h4>
        </div>

        {{-- COLLAPSE --}}
        <div class="col-2 text-right d-lg-none">

        <button class="m-0 p-0 btn btn-circle btn-sm bg-dark" data-toggle="collapse" data-target="#{{$status}}-{{$taskGroup->id}}" >
            <i class="far fa-eye icon-white"></i>
        </button>

        </div>

    </div>

    {{-- CONTENT --}}
    <div id="{{$status}}-{{$taskGroup->id}}" class="row m-0 bg-{{$status}}-light" data-collapse="js">
        <div class="col-12">
            <ul class="list-unstyled p-3">
                @php
                    $taskList = $taskGroup->getTasks($statusId);
                @endphp

                @foreach ($taskList as $task)
                <li data-taskid="{{$task->id}}">
                    @include('project.show.task', ['task' => $task] )
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>

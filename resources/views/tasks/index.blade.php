@extends('layouts.app')

@section('content')
<div class="container" data-controller="task-index">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tasks</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/tasks/create" data-action="click->task-index#form">New task</a>

                    <div>
                        @include('tasks/form')
                    </div>
                </div>
            </div>

            <div class="list-group mt-4">
                @foreach ($tasks as $task)
                    <a class="list-group-item list-group-item-action" href={{ $task->path() }}>
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $task->title }}</h5>
                            <small class="text-muted">XXX days ago</small>
                        </div>
                        <p class="mb-1">{{ $task->description }}</p>
                        {{-- <small class="text-muted">{{ $task->length }}</small> --}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

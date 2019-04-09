@extends('layouts.app')

@section('content')
<div class="container" data-controller="task-index" data-task-index-url="/tasks">
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

                    <a href="/tasks/create" data-action="click->task-index#toggleForm">New task</a>

                    <div class="d-none" data-target="task-index.form">
                        @include('tasks/form')
                    </div>
                </div>
            </div>

            <div data-target="task-index.list">
                @include('tasks.list')
            </div>
        </div>
    </div>
</div>
@endsection

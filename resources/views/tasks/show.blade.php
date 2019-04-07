@extends('layouts.app')

@section('content')
<div class="container" data-controller="task-show" data-task-show-url={{ $task->path() }}>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{ $task->title }}
                    </div>

                    <div>
                        <form method="POST"
                              action="{{ $task->hasUnstoppedTime() ?
                                            $task->path() . '/stop' :
                                            $task->path() . '/start' }}">
                            @csrf

                            <button
                                type="submit"
                                data-action="click->task-show#start-stop"
                                class="btn{{ $task->hasUnstoppedTime() ? ' btn-outline-danger' : ' btn-outline-success' }} btn-sm">
                                    {{ $task->hasUnstoppedTime() ? 'Stop' : 'Start' }}
                                </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $task->description }}
                </div>
            </div>

            <div data-target="task-show.times">
                @include('tasks.times')
            </div>
        </div>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between border-0">
                    <div>
                        {{ $task->title }}
                    </div>

                    <div>
                        <form method="POST" action="{{ $task->path() . '/toggle' }}">
                            @csrf

                            <button
                                type="submit"
                                class="btn{{ $task->hasUnstoppedTime() ? ' btn-outline-danger' : ' btn-outline-success' }} btn-sm"
                                >{{ $task->hasUnstoppedTime() ? 'Stop' : 'Start' }}</button>
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


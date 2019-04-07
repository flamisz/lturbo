@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{ $task->title }}
                    </div>

                    <div data-controller="startstop" data-startstop-url="{{ $task->path() }}"
                        @if ($task->hasUnstoppedTime())
                            <form method="POST" action="{{ $task->path() . '/stop' }}">
                                @csrf

                                <button
                                    type="submit"
                                    data-action="click->startstop#stop"
                                    class="btn btn-outline-danger btn-sm">Stop</button>
                            </form>
                        @else
                            <form method="POST" action="{{ $task->path() . '/start' }}">
                                @csrf

                                <button
                                    type="submit"
                                    data-action="click->startstop#start"
                                    class="btn btn-outline-success btn-sm">Start</button>
                            </form>
                        @endif
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

            <div class="card mt-4">
                <div class="card-header">
                    Times
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($task->times as $time)
                        {{ $time->start }} - {{ $time->stop }} {{ $time->length }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


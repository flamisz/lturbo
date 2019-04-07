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

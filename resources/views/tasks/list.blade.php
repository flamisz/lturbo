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

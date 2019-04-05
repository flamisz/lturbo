@foreach ($tasks as $task)
    {{ $task->title }}
    {{ $task->description }}
@endforeach

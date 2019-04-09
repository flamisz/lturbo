<form method="POST" action="/tasks">
    @csrf

    <div class="form-group row">
        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('name') }}" autofocus>

            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

        <div class="col-md-6">
            <textarea
                name="description"
                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description') }}</textarea>

            @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button
                type="submit"
                class="btn btn-primary"
                data-action="click->task-index#postForm"
                data-target="task-show.button">Create</button>
        </div>
    </div>
</form>

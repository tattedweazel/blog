{{ Form::open(['route' => ['update_tag_path', $tag->id]]) }}
    <div class="form-group-lg">
        <div class="input-group input-group-lg push-bottom">
            <input type="text" class="form-control" name="label" value="{{ $tag->label }}" required>
            <input type="submit" value="Update" class="btn btn-lg btn-primary btn-option"/>
            <a href="{{ URL::route('delete_tag_path', $tag->id) }}" class="btn btn-lg btn-danger btn-option">Delete</a>
        </div>
    </div>
{{ Form::close() }}
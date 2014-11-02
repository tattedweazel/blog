{{ Form::open(['route' => 'add_category_path']) }}
    <div class="form-group-lg">
        <div class="input-group input-group-lg push-bottom">
            <input type="text" class="form-control" name="label" placeholder="New Category" required>
            <input type="submit" value="Add" class="btn btn-lg btn-success btn-option"/>
        </div>
    </div>
{{ Form::close() }}
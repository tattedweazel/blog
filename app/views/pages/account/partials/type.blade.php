@if ($current_user->type == 'Admin' && $current_user->id != $account->id)
    <div class="container">
        {{ Form::open(['route' => ['update_user_type_path', $account->id]]) }}
        <div class="col-md-6 col-md-offset-3">
            <div class="input-group input-group-lg push-bottom">
                <select name="type" class="form-control">
                    <option value="Admin" {{ ($account->type == 'Admin') ? 'selected' : '' }}>Admin</option>
                    <option value="Author" {{ ($account->type == 'Author') ? 'selected' : '' }}>Author</option>
                    <option value="Mod" {{ ($account->type == 'Mod') ? 'selected' : '' }}>Moderator</option>
                    <option value="User" {{ ($account->type == 'User') ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div class="input-group input-group-lg">
                <input type="submit" value="Update User Type" class="btn btn-lg btn-warning"/>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endif
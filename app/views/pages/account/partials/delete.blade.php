@if ($current_user->type == 'Admin' && $current_user->id != $account->id)
    <div class="container">
        {{ Form::open(['route' => ['delete_user_path', $account->id]]) }}
        <div class="col-md-6 col-md-offset-3">
            <div class="input-group input-group-lg">
                <input type="submit" value="Delete User" class="btn btn-lg btn-danger"/>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endif
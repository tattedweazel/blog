<div class="container">
    {{ Form::open(['route' => ['update_password_path', $account->id]]) }}
    <div class="col-md-6 col-md-offset-3">
        <div class="input-group input-group-lg push-bottom">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>

        <div class="input-group input-group-lg push-bottom">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
        </div>

        <div class="input-group input-group-lg push-bottom">
            <input type="submit" value="Update Password" class="btn btn-lg btn-primary"/>
        </div>

    </div>
    {{ Form::close() }}
</div>
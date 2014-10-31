<div class="container">
    {{ Form::open(['route' => ['account_path', $account->id]]) }}
    <div class="col-md-6 col-md-offset-3">
        @include('partials.errors')
        <div class="form-group-lg">
            @include('pages.account.partials.privs')
            <div class="input-group input-group-lg push-bottom">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="name" placeholder="Username" value="{{ $account->name }}" required>
            </div>

            <div class="input-group input-group-lg push-bottom">
                <span class="input-group-addon">@</span>
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $account->email }}"required>
            </div>

            <div class="input-group input-group-lg push-bottom">
                <input type="submit" value="Update Info" class="btn btn-lg btn-primary"/>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
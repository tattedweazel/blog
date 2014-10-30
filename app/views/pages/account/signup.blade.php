@extends('layouts.default')

@section('content')

     <div class="container">

        <div class="container">
            @include('partials.errors')
            {{ Form::open(['route' => 'register_path']) }}
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group-lg">
                    <div class="input-group input-group-lg push-bottom">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Username" required>
                    </div>

                    <div class="input-group input-group-lg push-bottom">
                        <span class="input-group-addon">@</span>
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>

                    <div class="input-group input-group-lg push-bottom">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>

                    <div class="input-group input-group-lg push-bottom">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>

                    <div class="input-group input-group-lg">
                        <input type="submit" value="Complete" class="btn btn-lg btn-success"/>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
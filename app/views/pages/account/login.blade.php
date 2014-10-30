@extends('layouts.default')

@section('content')

    <div class="container">
        {{ Form::open(['route' => 'login_path']) }}
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group-lg">

                <div class="input-group input-group-lg push-bottom">
                    <span class="input-group-addon">@</span>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>

                <div class="input-group input-group-lg push-bottom">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>

                <div class="input-group input-group-lg">
                    <input type="submit" value="Begin" class="btn btn-lg btn-success"/>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>

@stop
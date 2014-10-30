@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <h2>Current Users</h2>
            <ul>
                @foreach ($users as $user)
                    <li>{{ $user->name }} - {{ $user->email }} - {{ $user->type }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@stop
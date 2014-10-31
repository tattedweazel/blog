@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <h2>Current Users</h2>
            <ul>
                @foreach ($users as $user)
                    <li>
                        <a href="{{ URL::route('account_path', $user->id) }}">
                            {{ $user->name }} - {{ $user->email }} - {{ $user->type }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop
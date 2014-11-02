@extends('layouts.default')

@section('content')
    <h1>Available Tags</h1>
    <div>
    @foreach ($tags as $tag)
        @include('pages.admin.partials.tag')
    @endforeach
    @include('pages.admin.partials.new_tag')
    </div>
@stop
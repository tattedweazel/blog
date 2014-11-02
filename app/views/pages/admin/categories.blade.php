@extends('layouts.default')

@section('content')
    <h1>Available Categories</h1>
    <div>
    @foreach ($categories as $category)
        @include('pages.admin.partials.category')
    @endforeach
    @include('pages.admin.partials.new_category')
    </div>
@stop
@extends('layouts.default')

@section('content')
    <h1>Recent Articles</h1>
    <ul>
    @foreach ($articles as $article)
        <li><a href="{{ URL::route('article_path', $article->slug) }}">{{ $article->title }}</a></li>
    @endforeach
    </ul>
@stop
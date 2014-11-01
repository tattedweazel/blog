@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>{{ $article->title }}</h1>
                <h4>{{ $article->sub_title }}</h4>
                <p>By: {{ $article->user->name }}</p>
                <p>Posted: {{ $article->created_at->diffForHumans() }}</p>
                @if ($article->created_at != $article->updated_at)
                    <p>Edited: {{ $article->updated_at->diffForHumans() }}</p>
                @endif
                <br/><br/>
                <p>{{ $article->body }}</p>
            </div>
        </div>
    </div>
    @include('pages.articles.partials.options')
@stop
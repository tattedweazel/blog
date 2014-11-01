@extends('layouts.default')

@section('content')
    <div class="container">
    {{ Form::open(['route' => ['edit_article_path', $article->slug]]) }}
        <div class="row">
            <div class="col-sm-10 push-bottom">
                @include('partials.errors')
                <input type="text" class="form-control" name="title" id="title" placeholder="Article Title" value="{{ $article->title }}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
                <input type="text" class="form-control" name="sub_title" id="sub_title" placeholder="Sub-title"  value="{{ $article->sub_title }}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
                <p>Author: {{ $article->user->name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
                <p>Article URL: {{ URL::route('article_path', $article->slug) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
                <textarea class="form-control" name="body" id="body" rows="12">{{ $article->body }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="public" value="1" {{ ($article->public) ? 'checked' : ''}}>
                        This is a Public article (non-users can read it)
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
                <div class="input-group input-group-lg push-bottom">
                    <input type="submit" value="Save Changes" class="btn btn-lg btn-primary"/>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-10 push-bottom">
            <p>*** If you lose your work to an error -- Don't freak out! Just hit your browser's "Back" button. It'll be there.</p>
        </div>
    </div>

    {{ Form::close() }}
    </div>
@stop
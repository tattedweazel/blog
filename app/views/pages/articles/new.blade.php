@extends('layouts.default')

@section('content')
    <div class="container">
    {{ Form::open(['route' => 'new_article_path']) }}
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
                <p>Author: {{ $current_user->name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
               @include('pages.articles.partials.category')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
                @include('pages.articles.partials.body_text')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
                @include('pages.articles.partials.public_checkbox')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 push-bottom">
                <div class="input-group input-group-lg push-bottom">
                    <input type="submit" value="Save!" class="btn btn-lg btn-primary"/>
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
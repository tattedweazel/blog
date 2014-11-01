@if ($current_user->canAdmin())
    {{ Form::open(['route' => ['delete_article_path', $article->id], 'class' => 'article-option']) }}
            <input type="submit" value="Delete" class="btn btn-lg btn-danger article-option"/>
    {{ Form::close() }}
@endif
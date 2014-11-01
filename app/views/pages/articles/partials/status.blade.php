@if ($current_user->canWrite())
    @if($article->published)
        {{ Form::open(['route' => ['unpublish_article_path', $article->id], 'class' => 'article-option']) }}
                <input type="submit" value="Un-Publish" class="btn btn-lg btn-warning article-option"/>
        {{ Form::close() }}
    @else
        {{ Form::open(['route' => ['publish_article_path', $article->id], 'class' => 'article-option']) }}
                <input type="submit" value="Publish!" class="btn btn-lg btn-success article-option"/>
        {{ Form::close() }}
    @endif
@endif
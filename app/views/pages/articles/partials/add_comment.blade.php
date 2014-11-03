@if ($current_user)
    @if(!$article->comments_locked)
        {{ Form::open(['route' => ['add_comment_path', $article->slug]]) }}
                <input type="text" name="body" placeholder="Leave a comment here" class="form-control"/>
                <input type="submit" value="Say it!" class="btn btn-primary article-option"/>
        {{ Form::close() }}
    @endif
@endif
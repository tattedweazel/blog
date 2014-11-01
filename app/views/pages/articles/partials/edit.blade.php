@if ($current_user->canWrite())
    <a href="{{ URL::route('edit_article_path', $article->slug) }}" class="btn btn-lg btn-primary article-option">Edit</a>
@endif
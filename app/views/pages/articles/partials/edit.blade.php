@if ($current_user->canWrite())
    <a href="{{ URL::route('edit_article_path', $article->slug) }}" class="btn btn-lg btn-primary">Edit</a>
@endif
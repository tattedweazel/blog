@if ($comment->disabled)
    <a href="{{ URL::route('enable_comment_path', $comment->id) }}" class="btn btn-primary article-option">Re-enable</a>
@else ($comment->disabled)
    <a href="{{ URL::route('disable_comment_path', $comment->id) }}" class="btn btn-warning article-option">Disable</a>
@endif
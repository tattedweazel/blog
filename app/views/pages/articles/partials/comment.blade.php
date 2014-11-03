<div class="comment-block">
    <div class="comment-details">
    Posted {{ $comment->created_at->diffForHumans() }}
    by {{ (isset($current_user) && $current_user->id == $comment->user_id) ? 'You' : $comment->user->name }}
    </div>
    <div class="comment-options">
        @if ($current_user && !$comment->disabled)
            @include('pages.articles.partials.user_actions')
        @endif
    </div>
    @if ($current_user && $current_user->canModerate())
        <div class="comment-mod-options">
            @include('pages.articles.partials.mod_actions')
        </div>
    @endif
    <div class="comment-body">
        <p>
            @if ($comment->disabled)
                {{ $comment->disabledText() }}
            @else
                {{ $comment->body }}
            @endif
        </p>
    </div>
</div>
<p>
    {{ $comment->score }}
    @if (! $comment->userOwnsComment($current_user->id))
        -
        @if(!$comment->userHasUpvoted($current_user->id))
            <a class="vote-link" href="{{ URL::route('upvote_comment_path', $comment->id) }}"><i class="fa fa-thumbs-o-up"></i> Up-vote</a>
        @endif

        @if(!$comment->userHasDownvoted($current_user->id))
            <a class="vote-link" href="{{ URL::route('downvote_comment_path', $comment->id) }}"><i class="fa fa-thumbs-o-down"></i> Down-vote</a>
        @endif

        @if (!$comment->userHasReported($current_user->id))
            :: <a class="report-link" href="{{ URL::route('report_comment_path', $comment->id) }}"><i class="fa fa-frown-o"></i> Report</a>
        @endif
    @endif
</p>
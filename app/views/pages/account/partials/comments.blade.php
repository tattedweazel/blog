@if ($comments && $comments->count())
<div class="container">
    <h4>My Comments</h4>
    <ul>
        @foreach($comments as $comment)
        <li>
            <a href="{{ URL::route('article_path', $comment->article->slug) }}">{{ $comment->article->title }}</a>
            <p>Score: {{ $comment->score }}</p>
            @if ($comment->disabled)
                <p>
                <h4>Your comment has been disabled my a Moderator</h4>
                </p>
            @else
                <p>{{ $comment->body }}</p>
            @endif
        </li>
        @endforeach
    </ul>
</div>
@endif
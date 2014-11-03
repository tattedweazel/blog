@include('pages.articles.partials.add_comment')
@if ($comments->count())
<h4>Comments: </h4>
    @foreach($comments as $comment)
        @include('pages.articles.partials.comment')
    @endforeach
@endif
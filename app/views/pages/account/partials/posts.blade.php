@if ($articles && $articles->count())
<div class="container">
    <h4>My Articles</h4>
    <ul>
        @foreach($articles as $article)
        <li><a href="{{ URL::route('article_path', $article->slug) }}">{{ $article->title }}</a></li>
        @endforeach
    </ul>
</div>
@endif
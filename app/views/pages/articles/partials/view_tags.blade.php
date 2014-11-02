@if ($tags->count())
    <p>tags:
        @foreach ($tags as $tag)
            <a class="tag-link" href="{{ URL::route('filter_by_tag_path', $tag->label) }}">{{ $tag->label }}</a>
        @endforeach
    </p>
@endif
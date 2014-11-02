 <div>
    <p> Current Tags:
        @foreach ($tags as $tag)
            <span class="tag-link">{{ $tag->label }} <a href="{{ URL::route('detach_tag_path', [$tag->id, $article->id]) }}" class="delete-icon"><i class="fa fa-close"></i></a></span>
        @endforeach
    </p>
 </div>
 <div class="input-group push-bottom">
    <select class="form-control push-bottom" id="add_tag" data-article="{{ $article->id }}">
        @foreach ($all_tags as $tag)
            <option value="{{$tag->id}}">{{ $tag->label }}</option>
        @endforeach
    </select>
    <a href="#" id="add_tag_btn" class="btn btn-primary btn-option">Add Tag</a>
</div>
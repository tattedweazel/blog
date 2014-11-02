@if ($categories && $categories->count())
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        @foreach($categories as $category)
            <li><a href="{{ URL::route('filter_by_category_path', $category->label) }}">{{ $category->label }}</a></li>
        @endforeach
    </ul>
</li>
@endif
@if ($current_user)
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $current_user->name }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ URL::route('account_path', $current_user->id) }}">My Info</a></li>
        @if ($current_user->canWrite())
            <li class="divider"></li>
            <li><a href="{{ URL::route('drafts_path') }}">View Drafts</a></li>
            <li><a href="{{ URL::route('new_article_path') }}">New Article</a></li>
            <li><a href="{{ URL::route('categories_path') }}">Edit Categories</a></li>
        @endif
        @if ($current_user->canAdmin())
            <li class="divider"></li>
            <li><a href="{{ URL::route('user_admin_path') }}">User Admin</a></li>
        @endif
        <li class="divider"></li>
        <li><a href="{{ URL::route('logout_path') }}">Log Out</a></li>
    </ul>
</li>
@endif
@if ($current_user && $current_user->canWrite())
    @include('pages.articles.partials.edit')
@endif
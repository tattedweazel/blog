@if ($current_user && $current_user->canWrite())
    @include('pages.articles.partials.edit')
    @include('pages.articles.partials.delete')
@endif
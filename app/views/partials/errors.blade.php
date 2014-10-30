@if ($errors->any())
    <div class="row">
        <ul>
        @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
@if (Session::get('status'))
    <p>{{ Session::get('status') }}</p>
@endif
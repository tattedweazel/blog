@unless($current_user)
    <li><a href="{{ URL::route('register_path') }}">Sign Up</a></li>
    <li><a href="{{ URL::route('login_path') }}">Log In</a></li>
@endunless
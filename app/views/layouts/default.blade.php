<!doctype html>
<html lang="en">

	<head>
		@include('partials.head')
	</head>

	<body>
        <header class="main-header">
            @include('partials.header')
        </header>

        <div class="main-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            @include('partials.footer')
        </footer>

	</body>

</html>

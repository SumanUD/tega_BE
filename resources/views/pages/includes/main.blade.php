<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
    @include('pages.includes.header')
    @yield('styles')
</head>
<body>
    <header>
        @include('pages.includes.nav')
    </header>
    @yield('content')
    @include('pages.includes.footer')

    @yield('scripts')
</body>
</html>
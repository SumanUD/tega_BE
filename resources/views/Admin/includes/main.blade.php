<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TegaIndustries @if ($__env->yieldContent('pageTitle')) | @yield('pageTitle') @endif</title>
    @include('Admin.includes.head')
    @yield('styles')
</head>

<body>
    <header>
        @include('Admin.includes.navbar')
    </header>
    @include('Admin.includes.sidebar')
    @yield('content')
    @include('Admin.includes.footer')
    @include('Admin.includes.script')
</body>

</html>
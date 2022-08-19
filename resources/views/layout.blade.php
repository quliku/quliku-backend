<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>

    @yield('beforecss')

    @include('partials._head')

    @yield('aftercss')
</head>

<body>
    @include('partials._navbar')

    <div class="max-w-6xl mx-auto px-4 py-5">
        @yield('content')
        @include('partials._footer')
    </div>

</body>

</html>

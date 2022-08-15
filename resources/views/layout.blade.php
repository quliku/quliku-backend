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

    <div class="container">
        @yield('content')
    </div>
    @include('partials._footer')
</body>

</html>

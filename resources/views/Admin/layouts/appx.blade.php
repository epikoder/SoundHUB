<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Config::get('app.name') }} @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/tailwind.css') }}>
    <script async src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" async></script>
    <!-- JQUE FOR DEV -->
    <script src={{ asset('js/jquery.min.js') }}></script>
</head>

<body>
    @include('Admin.partials.navbar')
    <div>
        @yield('content')
    </div>
</body>

</html>

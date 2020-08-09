<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }} @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/main.css') }}>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="module">
        import NP from 'https://cdn.jsdelivr.net/npm/nprogress@1.0.0-1/dist/nprogress.mjs';
        window.NP = NP;
        NP.start();
    </script>

</head>

<body>
    @include('Admin.partials.navbar')
    <div class="w-full flex">
        <div class="w-1/6 block">
            @include('Admin.partials.navlink')
        </div>
        <div class="w-5/6 block">
            @yield('content')
        </div>
    </div>
</body>

</html>

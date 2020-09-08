<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{env('APP_NAME')}} @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <link rel="stylesheet" href={{ asset('css/tailwind.css') }}>
    <script type="module" src=" {{asset('js/app.js')}} "></script>
    @stack('head')
</head>

<body>
    <header>
        @include('partials.navbar')
    </header>

    <main>
        <div class="sm:my-20 md:my-20 lg:my-16 xl:my-16 h-f">
            @yield('content')
        </div>
    </main>

    <footer>
        @include('partials.footer')
    </footer>
</body>

</html>

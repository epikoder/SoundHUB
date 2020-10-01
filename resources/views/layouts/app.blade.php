<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Config::get('app.name') }} @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <link rel="stylesheet" href={{ asset('css/tailwind.css') }}>
    <script type="module" src=" {{ asset('js/app.js') }} "></script>
    <script type="module" src=" {{ asset('js/search.js') }} "></script>
    <script type="module" src={{asset('js/player.js')}}></script>
    @stack('head')
</head>

<body>
    <header>
        @include('partials.navbar')
    </header>

    <main>
        <div class="sm:mt-20 md:mt-20 lg:mt-16 xl:mt-16 h-f">
            @yield('content')
        </div>
    </main>

    <footer>
        @include('partials.footer')
        @include('partials.player')
    </footer>
</body>

</html>

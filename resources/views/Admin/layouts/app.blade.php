<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Config::get('app.name') }} @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="module" src={{asset('js/admin/admin.js')}}></script>
    <link rel="stylesheet" href={{ asset('css/tailwind.css') }}>
    <link rel="stylesheet" href={{ asset('css/admin.css') }}>
    @stack('head')
</head>

<body>
    <header class="">
        @include('Admin.partials.navbar')
    </header>
    <main class="w-full">
        <nav>
            @include('Admin.partials.navlink')
        </nav>
        <div class="block w-full p-4">
            @yield('content')
        </div>
    </main>
    <footer class="">
        @includeIf('Admin.partials.footer')
    </footer>
</body>

</html>

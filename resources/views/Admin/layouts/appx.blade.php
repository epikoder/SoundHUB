<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Config::get('app.name') }} @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/tailwind.css') }}>
</head>

<body>
    @include('Admin.partials.navbar')
    <div>
        @yield('content')
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{env('APP_NAME')}} @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/main.css') }}>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script async src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" async></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/nprogress@1.0.0-1/dist/nprogress.mjs"></script>
    <script type="module">import NP from 'https://cdn.jsdelivr.net/npm/nprogress@1.0.0-1/dist/nprogress.mjs'; window.NP = NP; NP.start();</script>
    <!-- JQUE FOR DEV -->
    <script src={{ asset('js/jquery.min.js')}}></script>
</head>

<body>
    @include('partials.navbar')

    <div class="px-2">
        @yield('content')
    </div>
    <style lang="css">
        /* Make clicks pass-through */
        #nprogress {
            pointer-events: none;
        }

        #nprogress .bar {
            background: #29d;

            position: fixed;
            z-index: 1031;
            top: 0;
            left: 0;

            width: 100%;
            height: 2px;
        }

        /* Fancy blur effect */
        #nprogress .peg {
            display: block;
            position: absolute;
            right: 0px;
            width: 100px;
            height: 100%;
            box-shadow: 0 0 10px #29d, 0 0 5px #29d;
            opacity: 1.0;

            -webkit-transform: rotate(3deg) translate(0px, -4px);
            -ms-transform: rotate(3deg) translate(0px, -4px);
            transform: rotate(3deg) translate(0px, -4px);
        }

        /* Remove these to get rid of the spinner */
        #nprogress .spinner {
            display: block;
            position: fixed;
            z-index: 1031;
            top: 15px;
            right: 15px;
        }

        #nprogress .spinner-icon {
            width: 18px;
            height: 18px;
            box-sizing: border-box;

            border: solid 2px transparent;
            border-top-color: #29d;
            border-left-color: #29d;
            border-radius: 50%;

            -webkit-animation: nprogress-spinner 400ms linear infinite;
            animation: nprogress-spinner 400ms linear infinite;
        }

        .nprogress-custom-parent {
            overflow: hidden;
            position: relative;
        }

        .nprogress-custom-parent #nprogress .spinner,
        .nprogress-custom-parent #nprogress .bar {
            position: absolute;
        }

        @-webkit-keyframes nprogress-spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes nprogress-spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</body>

</html>

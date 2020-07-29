@extends('layouts.app')
@section('title', 'dashboard')

@section('content')
<div class="p-1 block w-full flex-col justify-between">
    @if ($artist)
    <div class="w-full h-10 flex px-1">
        <div class="p-px absolute mr-4 right-0 content-center">
            <a href={{ route('dashboard/user', ['name'=> $user->name]) }}
                class="outline-none bg-blue-500 hover:pointer rounded hover:outline-none right-0 absolute mx-1 px-1 lg:h-8 xl:h-8 md:h-6 sm:h-4 text-bold lg:text-lg xl:text-lg md:text-sm sm:text-xs text-white">
                Listen
            </a>
        </div>
    </div>
    @endif
    <div class="w-full m-1 px-1 justify-between flex">
        <div
            class="align-left lg:h-48 lg:w-48 xl:h-48 xl:w-48 md:h-40 md:w-40 sm:h-32 sm:w-32 rounded-full shadow-lg flex">
            <img src={{$user->avatar_url}} alt=""
                class="m-auto lg:h-40 lg:w-40 xl:h-40 xl:w-40 md:h-32 md:w-32 sm:h-24 sm:w-24 rounded-full cursor-pointer" />
        </div>
        <div class="flex-col flex m-auto lg:h-40 xl:h-40 md:h-32 sm:h-24 sm:w-9/12 md:w-4/5 lg:w-4/5 xl:w-4/5">
            <div class="w-11/12 m-auto font-sans">
                <div class="px-2 flex-col justify-between rounded">
                    <p class="xl:h-8 lg:h-8 md:h-8 sm:h-6 lg:text-lg xl:text-lg md:text-md sm:text-sm font-bold cursor-auto">
                        {{$artist->name}} <span>✔<span>
                    </p>
                    <div class="flex justify-between ">
                        <p class="w-11/12 xl:h-8 lg:h-8 md:h-8 sm:h-6 lg:text-lg xl:text-lg md:text-md sm:text-sm">
                            About:{{$artist->bio}}</p>
                        <button class="">
                            <img class="w-3 h-3" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDc3Ljg3MyA0NzcuODczIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0NzcuODczIDQ3Ny44NzM7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMzkyLjUzMywyMzguOTM3Yy05LjQyNiwwLTE3LjA2Nyw3LjY0MS0xNy4wNjcsMTcuMDY3VjQyNi42N2MwLDkuNDI2LTcuNjQxLDE3LjA2Ny0xNy4wNjcsMTcuMDY3SDUxLjINCgkJCWMtOS40MjYsMC0xNy4wNjctNy42NDEtMTcuMDY3LTE3LjA2N1Y4NS4zMzdjMC05LjQyNiw3LjY0MS0xNy4wNjcsMTcuMDY3LTE3LjA2N0gyNTZjOS40MjYsMCwxNy4wNjctNy42NDEsMTcuMDY3LTE3LjA2Nw0KCQkJUzI2NS40MjYsMzQuMTM3LDI1NiwzNC4xMzdINTEuMkMyMi45MjMsMzQuMTM3LDAsNTcuMDYsMCw4NS4zMzdWNDI2LjY3YzAsMjguMjc3LDIyLjkyMyw1MS4yLDUxLjIsNTEuMmgzMDcuMg0KCQkJYzI4LjI3NywwLDUxLjItMjIuOTIzLDUxLjItNTEuMlYyNTYuMDAzQzQwOS42LDI0Ni41NzgsNDAxLjk1OSwyMzguOTM3LDM5Mi41MzMsMjM4LjkzN3oiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCgk8Zz4NCgkJPHBhdGggZD0iTTQ1OC43NDIsMTkuMTQyYy0xMi4yNTQtMTIuMjU2LTI4Ljg3NS0xOS4xNC00Ni4yMDYtMTkuMTM4Yy0xNy4zNDEtMC4wNS0zMy45NzksNi44NDYtNDYuMTk5LDE5LjE0OUwxNDEuNTM0LDI0My45MzcNCgkJCWMtMS44NjUsMS44NzktMy4yNzIsNC4xNjMtNC4xMTMsNi42NzNsLTM0LjEzMywxMDIuNGMtMi45NzksOC45NDMsMS44NTYsMTguNjA3LDEwLjc5OSwyMS41ODUNCgkJCWMxLjczNSwwLjU3OCwzLjU1MiwwLjg3Myw1LjM4LDAuODc1YzEuODMyLTAuMDAzLDMuNjUzLTAuMjk3LDUuMzkzLTAuODdsMTAyLjQtMzQuMTMzYzIuNTE1LTAuODQsNC44LTIuMjU0LDYuNjczLTQuMTMNCgkJCWwyMjQuODAyLTIyNC44MDJDNDg0LjI1LDg2LjAyMyw0ODQuMjUzLDQ0LjY1Nyw0NTguNzQyLDE5LjE0MnoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==" />
                        </button>
                    </div>
                </div>
            </div>
            <div id="social" class="w-11/12 px-2 flex rounded shadow-md m-auto xl:h-12 lg:h-12 md:h-8 sm:h-6">
                <div class="flex px-2">
                    <a href="{{env('IG').'/'.(json_decode($artist->social)->instagram)}}" <?php
                    if (!json_decode($artist->social)->instagram) {
                        echo('class="pointer-events-none cursor-default"');
                    }
                    ?>>
                        <img src="{{env('IG').'/favicon.ico'}}" alt="" class="h-6 w-6 mx-2">
                    </a>
                    <a href="{{env('IG').'/'.(json_decode($artist->social)->twitter)}}" <?php
                    if (!json_decode($artist->social)->twitter) {
                        echo('class="pointer-events-none cursor-default"');
                    }
                    ?>>
                        <img src="{{env('TW').'/favicon.ico'}}" alt="" class="h-6 w-6 mx-2">
                    </a>
                </div>
                <button id="esb" onclick="es()" class="align-text-top">
                    <img class="w-3 h-3" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDc3Ljg3MyA0NzcuODczIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0NzcuODczIDQ3Ny44NzM7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMzkyLjUzMywyMzguOTM3Yy05LjQyNiwwLTE3LjA2Nyw3LjY0MS0xNy4wNjcsMTcuMDY3VjQyNi42N2MwLDkuNDI2LTcuNjQxLDE3LjA2Ny0xNy4wNjcsMTcuMDY3SDUxLjINCgkJCWMtOS40MjYsMC0xNy4wNjctNy42NDEtMTcuMDY3LTE3LjA2N1Y4NS4zMzdjMC05LjQyNiw3LjY0MS0xNy4wNjcsMTcuMDY3LTE3LjA2N0gyNTZjOS40MjYsMCwxNy4wNjctNy42NDEsMTcuMDY3LTE3LjA2Nw0KCQkJUzI2NS40MjYsMzQuMTM3LDI1NiwzNC4xMzdINTEuMkMyMi45MjMsMzQuMTM3LDAsNTcuMDYsMCw4NS4zMzdWNDI2LjY3YzAsMjguMjc3LDIyLjkyMyw1MS4yLDUxLjIsNTEuMmgzMDcuMg0KCQkJYzI4LjI3NywwLDUxLjItMjIuOTIzLDUxLjItNTEuMlYyNTYuMDAzQzQwOS42LDI0Ni41NzgsNDAxLjk1OSwyMzguOTM3LDM5Mi41MzMsMjM4LjkzN3oiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCgk8Zz4NCgkJPHBhdGggZD0iTTQ1OC43NDIsMTkuMTQyYy0xMi4yNTQtMTIuMjU2LTI4Ljg3NS0xOS4xNC00Ni4yMDYtMTkuMTM4Yy0xNy4zNDEtMC4wNS0zMy45NzksNi44NDYtNDYuMTk5LDE5LjE0OUwxNDEuNTM0LDI0My45MzcNCgkJCWMtMS44NjUsMS44NzktMy4yNzIsNC4xNjMtNC4xMTMsNi42NzNsLTM0LjEzMywxMDIuNGMtMi45NzksOC45NDMsMS44NTYsMTguNjA3LDEwLjc5OSwyMS41ODUNCgkJCWMxLjczNSwwLjU3OCwzLjU1MiwwLjg3Myw1LjM4LDAuODc1YzEuODMyLTAuMDAzLDMuNjUzLTAuMjk3LDUuMzkzLTAuODdsMTAyLjQtMzQuMTMzYzIuNTE1LTAuODQsNC44LTIuMjU0LDYuNjczLTQuMTMNCgkJCWwyMjQuODAyLTIyNC44MDJDNDg0LjI1LDg2LjAyMyw0ODQuMjUzLDQ0LjY1Nyw0NTguNzQyLDE5LjE0MnoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==" />
                </button>
            </div>
        </div>
    </div>
    <div id="menu" class="flex-col m-8 w-11/12 sm:text-center md:text-center">
        <div id="profile" class="flex-col border-2 bg-gray-200 rounded shadow my-2">
            <div class="w-full flex justify-between px-5">
                <p id="profile" class="p-1 w-full cursor-pointer" onclick="pr()">Profile</p>
            </div>
            <div id="profileI" class="px-5 font-sans text-sm bg-gray-100"></div>
        </div>
        <div id="media" class="flex-col border-2 bg-gray-200 rounded shadow lg:text-lg xl:text-lg">
            <div class="w-full flex justify-between px-5">
                <p id="media" class="p-1 w-full cursor-pointer" onclick="mb()">Media</p>
            </div>
            <div id="mediaI" class="px-5 font-sans text-sm bg-gray-100"></div>
        </div>
        <div id="metrics" class="flex-col border-2 bg-gray-200 rounded shadow lg:text-lg xl:text-lg">
            <div class="w-full flex justify-between px-5">
                <p id="media" class="p-1 w-full cursor-pointer" onclick="me()">Metrics</p>
            </div>
            <div id="metricsI" class="px-5 font-sans text-sm bg-gray-100"></div>
        </div>
        <div id="settings" class="flex-col border-2 bg-gray-200 rounded shadow lg:text-lg xl:text-lg">
            <div class="w-full flex justify-between px-5">
                <p id="settingsI" class="p-1 w-full cursor-pointer" onclick="se()">Settings</p>
            </div>
            <div id="mediaI" class="px-5 font-sans text-sm bg-gray-100"></div>
        </div>
    </div>
</div>

<div id="es"></div>
<script>
    var x = 0;
    $(document).ready(function () {
        window.NP.done();
    })

    $('#esb').one('click', function (){
        $('#es').addClass('fixed flex background w-full h-full top-0');
            $('#es').append(
            `<div class="z-20 m-auto flex-col sm:w-3/4 md:w-2/4 lg:w-2/4 xl:w-2/4 bg-white border-2 border-blue-400 p-2 shadow-lg rounded-md m-auto">
        <div class="w-full flex">
            <p id="status" class="w-11/12 px-2"></p>
            <button onclick="hide('#es')">X</button>
        </div>
        <form name="Sform" action={{ route('dashboard/social', ['name' => $artist->name]) }} method="get" class="m-auto p-4">
            @csrf
            <label for="IG">Instagram</label>
            <div class="mb-1">
                <input type="text" name="instagram" class="w-full px-1 focus:bg-white outline-none border-b-2 focus:border-green-300 input" value="{{json_decode($artist->social)->instagram}}" placeholder="SoundHUB">
            </div>
            <label for="IG">Twitter</label>
            <div class="mb-1">
                <input type="text" name="twitter" class="w-full px-1 focus:bg-white outline-none border-b-2 focus:border-green-300 input" value="{{json_decode($artist->social)->twitter}}" placeholder="SoundHUB">
            </div>
            <div class="w-full text-right m-1">
                <button class="bg-blue-500 text-white p-1">save</button>
            </div>
        </form>
        </div>`
        );
    })

    $('#media').one('click', function (){
        $('#mediaI').append(`
        <p class="w-full bg-white m-1 p-1 rounded lg:text-lg xl:text-lg text-center"><a href={{ route('dashboard/mediaindex', ['name'=>$artist->name]) }} class="w-full outline-none">My Songs</a></p>
        <p class="w-full bg-white m-1 p-1 rounded lg:text-lg xl:text-lg text-center"><a href={{ route('dashboard/upload', ['name'=>$artist->name]) }} class="w-full outline-none">Upload new Song</a></p>
        <p class="w-full bg-white m-1 p-1 rounded lg:text-lg xl:text-lg text-center"><a href={{ route('dashboard/album', ['name'=>$artist->name]) }} class="w-full outline-none">Upload Album</a></p>
        `);
        x = 1;
    })

    function es() {
        return $('#es').show();
    }
    function hide(x) {
        return $(x).hide();
    }
    $(document).on('submit', 'form', function (e) {
        e.preventDefault();
        save();
    })

    function mb(){
        if (x) {
            x = 0;
            return $('#mediaI').hide();
        }
        x = 1;
        return $('#mediaI').show();
    }
    function pr() {}
    function me() {}
    function se() {}

    function save () {
        window.NP.start();
        var url = $('form').attr('action');
        var form = new FormData($('Sform').get(0));
        form.append('_token', $('input[name="_token"]').val());
        form.append('instagram', $('input[name="instagram"]').val());
        form.append('twitter', $('input[name="twitter"]').val());
        axios.post(url, form).then((response) => {
            if (response.status != 200) {
                $('#status').addClass('text-red-500');
                $('#status').append(
                    `An Error Occured!`
                );
                window.NP.done();
                return false;
            }
            window.NP.done();
            $('#es').hide();
            console.log(response.data);
            //location.reload();
        })
    }
</script>
@endsection

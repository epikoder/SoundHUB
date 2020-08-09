@extends('layouts.app')
@section('title', 'dashboard')

@section('content')
<div class="p-1 w-full flex-col justify-between">
    <div class="w-full m-1 px-1 justify-between flex">
        <div
            class="align-left lg:h-48 lg:w-48 xl:h-48 xl:w-48 md:h-40 md:w-40 sm:h-32 sm:w-32 rounded-full shadow-lg flex">
            <img src={{$user->avatar_url}} alt=""
                class="m-auto lg:h-40 lg:w-40 xl:h-40 xl:w-40 md:h-32 md:w-32 sm:h-24 sm:w-24 rounded-full cursor-pointer" />
        </div>
        <div class="flex-col flex m-auto sm:w-9/12 md:w-4/5 lg:w-4/5 xl:w-4/5">
            <div class="w-11/12 m-auto font-sans">
                <div class="px-2 flex-col justify-between rounded">
                    <p class="xl:h-8 lg:h-8 md:h-8 sm:h-6 lg:text-lg xl:text-lg md:text-md sm:text-sm font-bold cursor-auto">
                        {{$artist->name}} <span>✔<span>
                    </p>
                    <div class="flex justify-between ">
                        <p class="w-11/12 p-2 lg:text-lg xl:text-lg md:text-md sm:text-sm">
                            About: {{$artist->bio}}</p>
                        <button id="abb" class="focus:outline-none" onclick="ab()">
                            <img class="w-3 h-3 outline-none" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDc3Ljg3MyA0NzcuODczIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0NzcuODczIDQ3Ny44NzM7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMzkyLjUzMywyMzguOTM3Yy05LjQyNiwwLTE3LjA2Nyw3LjY0MS0xNy4wNjcsMTcuMDY3VjQyNi42N2MwLDkuNDI2LTcuNjQxLDE3LjA2Ny0xNy4wNjcsMTcuMDY3SDUxLjINCgkJCWMtOS40MjYsMC0xNy4wNjctNy42NDEtMTcuMDY3LTE3LjA2N1Y4NS4zMzdjMC05LjQyNiw3LjY0MS0xNy4wNjcsMTcuMDY3LTE3LjA2N0gyNTZjOS40MjYsMCwxNy4wNjctNy42NDEsMTcuMDY3LTE3LjA2Nw0KCQkJUzI2NS40MjYsMzQuMTM3LDI1NiwzNC4xMzdINTEuMkMyMi45MjMsMzQuMTM3LDAsNTcuMDYsMCw4NS4zMzdWNDI2LjY3YzAsMjguMjc3LDIyLjkyMyw1MS4yLDUxLjIsNTEuMmgzMDcuMg0KCQkJYzI4LjI3NywwLDUxLjItMjIuOTIzLDUxLjItNTEuMlYyNTYuMDAzQzQwOS42LDI0Ni41NzgsNDAxLjk1OSwyMzguOTM3LDM5Mi41MzMsMjM4LjkzN3oiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCgk8Zz4NCgkJPHBhdGggZD0iTTQ1OC43NDIsMTkuMTQyYy0xMi4yNTQtMTIuMjU2LTI4Ljg3NS0xOS4xNC00Ni4yMDYtMTkuMTM4Yy0xNy4zNDEtMC4wNS0zMy45NzksNi44NDYtNDYuMTk5LDE5LjE0OUwxNDEuNTM0LDI0My45MzcNCgkJCWMtMS44NjUsMS44NzktMy4yNzIsNC4xNjMtNC4xMTMsNi42NzNsLTM0LjEzMywxMDIuNGMtMi45NzksOC45NDMsMS44NTYsMTguNjA3LDEwLjc5OSwyMS41ODUNCgkJCWMxLjczNSwwLjU3OCwzLjU1MiwwLjg3Myw1LjM4LDAuODc1YzEuODMyLTAuMDAzLDMuNjUzLTAuMjk3LDUuMzkzLTAuODdsMTAyLjQtMzQuMTMzYzIuNTE1LTAuODQsNC44LTIuMjU0LDYuNjczLTQuMTMNCgkJCWwyMjQuODAyLTIyNC44MDJDNDg0LjI1LDg2LjAyMyw0ODQuMjUzLDQ0LjY1Nyw0NTguNzQyLDE5LjE0MnoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==" />
                        </button>
                    </div>
                </div>
            </div>
            <div id="social" class="w-11/12 px-2 flex rounded shadow-md m-auto xl:h-12 lg:h-12 md:h-10 sm:h-8">
                <div class="flex px-2">
                    <a href="{{env('IG').'/'.(json_decode($artist->social)->instagram)}}" <?php
                    if (!json_decode($artist->social)->instagram) {
                        echo('class="pointer-events-none cursor-default"');
                    }
                    ?> target="_blank">
                        <img src="{{env('IG').'/favicon.ico'}}" alt="" class="h-6 w-6 mx-2">
                    </a>
                    <a href="{{env('IG').'/'.(json_decode($artist->social)->twitter)}}" <?php
                    if (!json_decode($artist->social)->twitter) {
                        echo('class="pointer-events-none cursor-default"');
                    }
                    ?> target="_blank">
                        <img src="{{env('TW').'/favicon.ico'}}" alt="" class="h-6 w-6 mx-2">
                    </a>
                </div>
                <button id="esb" onclick="es()" class="align-text-top focus:outline-none">
                    <img class="w-3 h-3" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDc3Ljg3MyA0NzcuODczIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0NzcuODczIDQ3Ny44NzM7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMzkyLjUzMywyMzguOTM3Yy05LjQyNiwwLTE3LjA2Nyw3LjY0MS0xNy4wNjcsMTcuMDY3VjQyNi42N2MwLDkuNDI2LTcuNjQxLDE3LjA2Ny0xNy4wNjcsMTcuMDY3SDUxLjINCgkJCWMtOS40MjYsMC0xNy4wNjctNy42NDEtMTcuMDY3LTE3LjA2N1Y4NS4zMzdjMC05LjQyNiw3LjY0MS0xNy4wNjcsMTcuMDY3LTE3LjA2N0gyNTZjOS40MjYsMCwxNy4wNjctNy42NDEsMTcuMDY3LTE3LjA2Nw0KCQkJUzI2NS40MjYsMzQuMTM3LDI1NiwzNC4xMzdINTEuMkMyMi45MjMsMzQuMTM3LDAsNTcuMDYsMCw4NS4zMzdWNDI2LjY3YzAsMjguMjc3LDIyLjkyMyw1MS4yLDUxLjIsNTEuMmgzMDcuMg0KCQkJYzI4LjI3NywwLDUxLjItMjIuOTIzLDUxLjItNTEuMlYyNTYuMDAzQzQwOS42LDI0Ni41NzgsNDAxLjk1OSwyMzguOTM3LDM5Mi41MzMsMjM4LjkzN3oiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCgk8Zz4NCgkJPHBhdGggZD0iTTQ1OC43NDIsMTkuMTQyYy0xMi4yNTQtMTIuMjU2LTI4Ljg3NS0xOS4xNC00Ni4yMDYtMTkuMTM4Yy0xNy4zNDEtMC4wNS0zMy45NzksNi44NDYtNDYuMTk5LDE5LjE0OUwxNDEuNTM0LDI0My45MzcNCgkJCWMtMS44NjUsMS44NzktMy4yNzIsNC4xNjMtNC4xMTMsNi42NzNsLTM0LjEzMywxMDIuNGMtMi45NzksOC45NDMsMS44NTYsMTguNjA3LDEwLjc5OSwyMS41ODUNCgkJCWMxLjczNSwwLjU3OCwzLjU1MiwwLjg3Myw1LjM4LDAuODc1YzEuODMyLTAuMDAzLDMuNjUzLTAuMjk3LDUuMzkzLTAuODdsMTAyLjQtMzQuMTMzYzIuNTE1LTAuODQsNC44LTIuMjU0LDYuNjczLTQuMTMNCgkJCWwyMjQuODAyLTIyNC44MDJDNDg0LjI1LDg2LjAyMyw0ODQuMjUzLDQ0LjY1Nyw0NTguNzQyLDE5LjE0MnoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==" />
                </button>
            </div>
        </div>
    </div>
    <div class="justify-center flex">
        <div id="menu" class="flex-col self-center w-11/12 text-center">
            <div class="flex-col rounded my-2">
                <p id="profile" class="p-1 w-full cursor-pointer shadow border-l-4 border-r-4 hover:border-gray-700 input" onclick="pr()">Profile</p>
                <div id="profileI" class="font-sans text-sm"></div>
            </div>
            <div class="flex-col rounded my-2">
                <p id="media" class="p-1 w-full cursor-pointer shadow border-l-4 border-r-4 hover:border-gray-700 input" onclick="mb()">Media</p>
                <div id="mediaI" class="font-sans text-sm"></div>
            </div>
            <div class="flex-col rounded my-2">
                <p id="promo" class="p-1 w-full cursor-pointer shadow border-l-4 border-r-4 hover:border-gray-700 input" onclick="ps()">Promote Song</p>
                <div id="promoI" class="px-5 font-sans text-sm"></div>
            </div>
            <div class="flex-col rounded my-2">
                <p id="metrics" class="p-1 w-full cursor-pointer shadow border-l-4 border-r-4 hover:border-gray-700 input" onclick="me()">Metrics</p>
                <div id="metricsI" class="px-5 font-sans text-sm"></div>
            </div>
            <div class="flex-col rounded my-2">
                <p id="settings" class="p-1 w-full cursor-pointer shadow border-l-4 border-r-4 hover:border-gray-700 input" onclick="se()">Settings</p>
                <div id="settingsI" class="px-5 font-sans text-sm"></div>
            </div>
        </div>
    </div>
</div>

<div id="es"></div>
<div id="ab"></div>
<script>
    var a;var b;var c;var d;var e;
    $('#esb').one('click', function (){
        $('#es').addClass('fixed flex background w-full h-full top-0');
            $('#es').append(
            `<div class="z-20 m-auto flex-col sm:w-3/4 md:w-2/4 lg:w-2/4 xl:w-2/4 bg-white border-2 p-2 shadow-lg rounded-md m-auto">
        <div class="w-full">
            <button onclick="hide('#es')" class="focus:outline-none float-right">
                <img class="w-3 h-3" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyLjAwMSA1MTIuMDAxIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIuMDAxIDUxMi4wMDE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMjg0LjI4NiwyNTYuMDAyTDUwNi4xNDMsMzQuMTQ0YzcuODExLTcuODExLDcuODExLTIwLjQ3NSwwLTI4LjI4NWMtNy44MTEtNy44MS0yMC40NzUtNy44MTEtMjguMjg1LDBMMjU2LDIyNy43MTcNCgkJCUwzNC4xNDMsNS44NTljLTcuODExLTcuODExLTIwLjQ3NS03LjgxMS0yOC4yODUsMGMtNy44MSw3LjgxMS03LjgxMSwyMC40NzUsMCwyOC4yODVsMjIxLjg1NywyMjEuODU3TDUuODU4LDQ3Ny44NTkNCgkJCWMtNy44MTEsNy44MTEtNy44MTEsMjAuNDc1LDAsMjguMjg1YzMuOTA1LDMuOTA1LDkuMDI0LDUuODU3LDE0LjE0Myw1Ljg1N2M1LjExOSwwLDEwLjIzNy0xLjk1MiwxNC4xNDMtNS44NTdMMjU2LDI4NC4yODcNCgkJCWwyMjEuODU3LDIyMS44NTdjMy45MDUsMy45MDUsOS4wMjQsNS44NTcsMTQuMTQzLDUuODU3czEwLjIzNy0xLjk1MiwxNC4xNDMtNS44NTdjNy44MTEtNy44MTEsNy44MTEtMjAuNDc1LDAtMjguMjg1DQoJCQlMMjg0LjI4NiwyNTYuMDAyeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
            </button>
        </div>
        <form name="Sform" action={{ route('dashboard.social', ['name' => $artist->name]) }} method="get" class="m-auto p-4">
            @csrf
            <label for="IG">Instagram</label>
            <div class="mb-1">
                <input type="text" name="instagram" class="w-full px-1 focus:bg-white outline-none border-b-2 focus:border-green-300 input" value="{{json_decode($artist->social)->instagram}}" placeholder="{{env('APP_NAME')}}">
            </div>
            <label for="IG">Twitter</label>
            <div class="mb-1">
                <input type="text" name="twitter" class="w-full px-1 focus:bg-white outline-none border-b-2 focus:border-green-300 input" value="{{json_decode($artist->social)->twitter}}" placeholder="{{env('APP_NAME')}}">
            </div>
            <div class="w-full text-right m-1">
                <button class="bg-blue-500 text-white p-1" onclick="save()">save</button>
            </div>
        </form>
        </div>`
        );
    })
    $('#abb').one('click', function () {
        $('#ab').addClass('fixed flex background w-full h-full top-0');
        $('#ab').append(
            `<div class="z-20 m-auto flex-col sm:w-3/4 md:w-2/4 lg:w-2/4 xl:w-2/4 bg-white border-2 p-2 shadow-lg rounded-md m-auto">
                <div class="w-full">
                    <button onclick="hide('#ab')" class="focus:outline-none float-right">
                        <img class="w-3 h-3" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyLjAwMSA1MTIuMDAxIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIuMDAxIDUxMi4wMDE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMjg0LjI4NiwyNTYuMDAyTDUwNi4xNDMsMzQuMTQ0YzcuODExLTcuODExLDcuODExLTIwLjQ3NSwwLTI4LjI4NWMtNy44MTEtNy44MS0yMC40NzUtNy44MTEtMjguMjg1LDBMMjU2LDIyNy43MTcNCgkJCUwzNC4xNDMsNS44NTljLTcuODExLTcuODExLTIwLjQ3NS03LjgxMS0yOC4yODUsMGMtNy44MSw3LjgxMS03LjgxMSwyMC40NzUsMCwyOC4yODVsMjIxLjg1NywyMjEuODU3TDUuODU4LDQ3Ny44NTkNCgkJCWMtNy44MTEsNy44MTEtNy44MTEsMjAuNDc1LDAsMjguMjg1YzMuOTA1LDMuOTA1LDkuMDI0LDUuODU3LDE0LjE0Myw1Ljg1N2M1LjExOSwwLDEwLjIzNy0xLjk1MiwxNC4xNDMtNS44NTdMMjU2LDI4NC4yODcNCgkJCWwyMjEuODU3LDIyMS44NTdjMy45MDUsMy45MDUsOS4wMjQsNS44NTcsMTQuMTQzLDUuODU3czEwLjIzNy0xLjk1MiwxNC4xNDMtNS44NTdjNy44MTEtNy44MTEsNy44MTEtMjAuNDc1LDAtMjguMjg1DQoJCQlMMjg0LjI4NiwyNTYuMDAyeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
                    </button>
                </div>
                <form name="Aform" action={{ route('dashboard.about', ['name' => $artist->name]) }} method="get" class="m-auto p-4">
                    <textarea id="about" type="text" name="about" class="w-full input p-2 m-2 outline-none rounded border-2 h-64 scroll overflow-hidden" cols="30" rows="10" maxlength="255">{{$artist->bio}}</textarea>
                <div class="w-full text-right m-1">
                    <button class="bg-blue-500 text-white p-1" onclick="asave()">save</button>
                </div>
                </form>
            </div>`
        );
    });

    $('#profile').one('click', function (){
        $('#profileI').append(`
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/password', ['name'=>$artist->name]) }} class="outline-none">Change Password</a></p>
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/picture', ['name'=>$artist->name]) }} class="outline-none">Change Picture</a></p>
        `);
        a = 1;
    });
    $('#media').one('click', function (){
        $('#mediaI').append(`
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/mediaindex', ['name'=>$artist->name]) }} class="outline-none">My Songs</a></p>
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/upload', ['name'=>$artist->name]) }} class="outline-none">Upload new Song</a></p>
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/album', ['name'=>$artist->name]) }} class=" outline-none">Upload Album</a></p>
        `);
        b = 1;
    });
    $('#promo').one('click', function (){
        $('#promoI').append(`
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/promo', ['name'=>$artist->name]) }} class="outline-none">Promote Song/Album</a></p>
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/promostats', ['name'=>$artist->name]) }} class="outline-none">Status</a></p>
        `);
        c = 1;
    });
    $('#metrics').one('click', function (){
        $('#metricsI').append(`
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/mediaindex', ['name'=>$artist->name]) }} class="outline-none">My Songs</a></p>
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/upload', ['name'=>$artist->name]) }} class="outline-none">Upload new Song</a></p>
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/album', ['name'=>$artist->name]) }} class=" outline-none">Upload Album</a></p>
        `);
        d = 1;
    });
    $('#settings').one('click', function (){
        $('#settingsI').append(`
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/mediaindex', ['name'=>$artist->name]) }} class="outline-none">Account</a></p>
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/upload', ['name'=>$artist->name]) }} class="outline-none">Subscription</a></p>
        <p class="w-full p-1 rounded text-center"><a href={{ route('dashboard/album', ['name'=>$artist->name]) }} class=" outline-none">Upload Album</a></p>
        `);
        e = 1;
    });

    function es() {
        return $('#es').show();
    }
    function ab() {
        return $('#ab').show();
    }
    function hide(x) {
        return $(x).hide();
    }
    $(document).on('submit', 'form', function (e) {
        e.preventDefault();
    })

    function pr() {
        if (a) {
            a = 0;
            $('#profile').removeClass('bg-gray-200');
            return $('#profileI').hide();
        }
        a = 1;
        $('#profile').addClass('bg-gray-200');
        return $('#profileI').show();
    }
    function mb(){
        if (b) {
            b = 0;
            $('#media').removeClass('bg-gray-200');
            return $('#mediaI').hide();
        }
        b = 1;
        $('#media').addClass('bg-gray-200');
        return $('#mediaI').show();
    }
    function ps() {
        if (c) {
            c = 0;
            $('#promo').removeClass('bg-gray-200');
            return $('#promoI').hide()
        }
        c = 1;
        $('#promo').addClass('bg-gray-200');
        return $('#promoI').show();
    }
    function me() {
        if (d) {
            d = 0;
            $('#metrics').removeClass('bg-gray-200');
            return $('#metricsI').hide()
        }
        d = 1;
        $('#metrics').addClass('bg-gray-200');
        return $('#metricsI').show();
    }
    function se() {
        if (e) {
            e = 0;
            $('#settings').removeClass('bg-gray-200');
            return $('#settingsI').hide()
        }
        e = 1;
        $('#settings').addClass('bg-gray-200');
        return $('#settingsI').show();
    }

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
            location.reload();
        })
    }

    function asave() {
        window.NP.start();
        var url = $('form').attr('action');
        var form = new FormData;
        form.append('about', $.trim($('#about').val()));
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
            $('#ab').hide();
            location.reload();
        });
    }
</script>
@endsection

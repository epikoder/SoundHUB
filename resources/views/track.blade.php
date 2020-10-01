@extends('layouts.app')
@section('title', '')
    @includeIf('info.home')
@section('content')
    @php
    $user = Session::get('user');
    @endphp
    <div style="background: {{$mainColor[1]}}" class="w-full h-full">
        <div style="background: {{$mainColor[0]}}" class="flex-col">
            <img class="lg:w-1/6 xl:w-1/6 sm:w-2/4 md:w-2/4 ml-auto mr-auto pt-6 pb-4 art" src=" {{ $track->art }} " alt="">
            <div class="flex info">
                <div class="ml-auto mr-auto text-bold text-white text-center">
                    <p class="ml-auto mr-auto text-3xl"> {{ $track->title }} </p>
                    <div class="px-4">
                        <span class="px-2"> {{ $track->artist }} •</span>
                        <span class="px-2"> {{ $track->genre }} •</span>
                        <span class="px-2"> {{ $track->duration }} </span>
                    </div>
                </div>
            </div>
            <div class="py-4 flex">
                <div class="mr-auto ml-auto flex">
                    <a href="{{ route('artist', ['name' => $track->artist]) }}"><span
                            class="px-2 py-1 mx-2 focus:outline-none border-2 b-rounded bg-gray-100 text-black font-bold font-mono">See
                            Artist</span></a>
                    @if ($track->owner_type == 'App\Models\Albums')
                        <a
                            href="{{ route('album', ['artist' => $track->artist, 'slug' => $track->owner->slug]) }}"><span
                                class="px-2 py-1 mx-2 focus:outline-none border-2 b-rounded bg-gray-100 text-black font-bold font-mono">See
                                Album</span></a>
                    @endif
                    <button id="play"
                        class="px-2 mx-2 flex focus:outline-none border-2 b-rounded bg-gray-100 text-black font-bold font-mono">
                        <img class="h-6 px-2"
                            src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik00MTIuOTA3LDIxNC4wOEMzOTguNCwxNDAuNjkzLDMzMy42NTMsODUuMzMzLDI1Niw4NS4zMzNjLTYxLjY1MywwLTExNS4wOTMsMzQuOTg3LTE0MS44NjcsODYuMDgNCgkJCUM1MC4wMjcsMTc4LjM0NywwLDIzMi42NCwwLDI5OC42NjdjMCw3MC43Miw1Ny4yOCwxMjgsMTI4LDEyOGgyNzcuMzMzQzQ2NC4yMTMsNDI2LjY2Nyw1MTIsMzc4Ljg4LDUxMiwzMjANCgkJCUM1MTIsMjYzLjY4LDQ2OC4xNiwyMTguMDI3LDQxMi45MDcsMjE0LjA4eiBNMjU2LDM4NEwxNDkuMzMzLDI3Ny4zMzNoNjRWMTkyaDg1LjMzM3Y4NS4zMzNoNjRMMjU2LDM4NHoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==" />
                        <span class="inline-block">Play</span>
                    </button>
                    <button
                        class="px-2 mx-2 flex focus:outline-none border-2 b-rounded bg-gray-100 text-black font-bold font-mono">
                        <img class="h-6 px-2"
                            src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSIwIDAgNTEyIDUxMi4wMDU3OCIgd2lkdGg9IjUxMnB0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im01MDcuNTIzNDM4IDE0OC44OTA2MjUtMTM4LjY2Nzk2OS0xNDRjLTQuNTIzNDM4LTQuNjkxNDA2LTExLjQ1NzAzMS02LjE2NDA2My0xNy40OTIxODgtMy43MzQzNzUtNi4wNTg1OTMgMi40NTMxMjUtMTAuMDI3MzQzIDguMzIwMzEyLTEwLjAyNzM0MyAxNC44NDc2NTZ2NjkuMzM1OTM4aC01LjMzMjAzMmMtMTE0LjY4NzUgMC0yMDggOTMuMzEyNS0yMDggMjA4djMyYzAgNy40MjE4NzUgNS4yMjY1NjMgMTMuNjA5Mzc1IDEyLjQ1NzAzMiAxNS4yOTY4NzUgMS4xNzU3ODEuMjk2ODc1IDIuMzQ3NjU2LjQyNTc4MSAzLjUxOTUzMS40MjU3ODEgNi4wMzkwNjIgMCAxMS44MjAzMTItMy41NDI5NjkgMTQuNjEzMjgxLTkuMTA5Mzc1IDI5Ljk5NjA5NC02MC4wMTE3MTkgOTAuMzA0Njg4LTk3LjI4MTI1IDE1Ny4zOTg0MzgtOTcuMjgxMjVoMjUuMzQzNzV2NjkuMzMyMDMxYzAgNi41MzEyNSAzLjk2ODc1IDEyLjM5ODQzOCAxMC4wMjczNDMgMTQuODI4MTI1IDUuOTk2MDk0IDIuNDUzMTI1IDEyLjk2ODc1Ljk2MDkzOCAxNy40OTIxODgtMy43MzQzNzVsMTM4LjY2Nzk2OS0xNDRjNS45NzI2NTYtNi4yMDcwMzEgNS45NzI2NTYtMTUuOTc2NTYyIDAtMjIuMjA3MDMxem0wIDAiLz48cGF0aCBkPSJtNDQ4LjAwMzkwNiA1MTIuMDAzOTA2aC0zODRjLTM1LjI4NTE1NiAwLTYzLjk5OTk5OTc1LTI4LjcxMDkzNy02My45OTk5OTk3NS02NHYtMjk4LjY2NDA2MmMwLTM1LjI4NTE1NiAyOC43MTQ4NDM3NS02NCA2My45OTk5OTk3NS02NGg2NGMxMS43OTY4NzUgMCAyMS4zMzIwMzIgOS41MzUxNTYgMjEuMzMyMDMyIDIxLjMzMjAzMXMtOS41MzUxNTcgMjEuMzMyMDMxLTIxLjMzMjAzMiAyMS4zMzIwMzFoLTY0Yy0xMS43NzczNDQgMC0yMS4zMzU5MzcgOS41NTg1OTQtMjEuMzM1OTM3IDIxLjMzNTkzOHYyOTguNjY0MDYyYzAgMTEuNzc3MzQ0IDkuNTU4NTkzIDIxLjMzNTkzOCAyMS4zMzU5MzcgMjEuMzM1OTM4aDM4NGMxMS43NzM0MzggMCAyMS4zMzIwMzItOS41NTg1OTQgMjEuMzMyMDMyLTIxLjMzNTkzOHYtMTcwLjY2NDA2MmMwLTExLjc5Njg3NSA5LjUzNTE1Ni0yMS4zMzU5MzggMjEuMzMyMDMxLTIxLjMzNTkzOCAxMS44MDA3ODEgMCAyMS4zMzU5MzcgOS41MzkwNjMgMjEuMzM1OTM3IDIxLjMzNTkzOHYxNzAuNjY0MDYyYzAgMzUuMjg5MDYzLTI4LjcxNDg0NCA2NC02NCA2NHptMCAwIi8+PC9zdmc+" />
                        <span>Share</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="h-16 text-center">
            <p>ADS ADS ADS</p>
        </div>
        <div class="flex">
            @includeIf('promotion')
            @includeIf('related')
        </div>
    </div>
@endsection
@push('head')
@javascript('_type', 'track')
@javascript('slug', $track->slug)
@javascript('playUrl', route('play'))
@javascript('search', route('search'))
@endpush

@extends('layouts.app')
@section('title', '')
    @includeIf('info.home')
@section('content')
    @php
    $user = Session::get('user');
    @endphp
    <div class="w-full div">
        <div class="sm:flex-col md:flex-col flex cover_art_lg">
            <div class="art-cropper">
                <img class="art-artist p-2" src=" {{ $artist->avatar }} " alt="">
            </div>
            <div class="block pt-6 sm:py-4 md:py-4 text-white info">
                <p class="text-3xl"> {{ $artist->name }} </p>
                <p class="text-sm"> {{ $artist->genre }} </p>
                <div class="pt-4">
                    <p class="flex">
                        <a href="{{ env('TW') . '/' . json_decode($artist->social)->twitter }}" @php if
                            (!json_decode($artist->social)->twitter) {
                            echo('class="pointer-events-none cursor-default"');
                            }
                            @endphp target="_blank">
                            <img loading="lazy" src="{{ env('TW') . '/favicon.ico' }}" alt="" class="h-8 w-8 mx-2">
                        </a>
                        <a href="{{ env('IG') . '/' . json_decode($artist->social)->instagram }}" @php if
                            (!json_decode($artist->social)->instagram) {
                            echo('class="pointer-events-none cursor-default"');
                            }
                            @endphp target="_blank">
                            <img loading="lazy" src="{{ env('IG') . '/favicon.ico' }}" alt="" class="h-8 w-8 mx-2">
                        </a>
                    </p>
                </div>
            </div>
            <div class="text-center mt-auto sm:ml-auto md:ml-auto mr-auto pb-2 text-white text-sm font-mono flex">
                <p class="px-2"> {{ $album_num }} album(s) </p>
                <p class="px-2"> {{ $track_num }} track(s) </p>
            </div>
        </div>
        <div class="h-16 text-center">
            <p>ADS ADS ADS</p>
        </div>
        <div class="flex">
            @includeIf('related')
            @includeIf('promotion')
        </div>
    </div>
    <script type="module">
    </script>
    <style>
        .cover_art_lg {
            background: {
                    {
                    $mainColor[0]
                }
            }

            ;
            transition: all;
        }

        .art-artist {
            width: 350px;
            height: 350px;
            object-fit: cover;
            border-radius: 50%;

            border-color: {
                    {
                    $mainColor[2]
                }
            }

            ;
        }

        .div {
            background: {
                    {
                    $mainColor[1]
                }
            }

            ;
        }

    </style>
    @includeIf('promotion')
@endsection

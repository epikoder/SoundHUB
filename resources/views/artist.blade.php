@extends('layouts.app')
@section('title', '')
    @includeIf('info.home')
@section('content')
    <div style="background: {{$mainColor[1]}};" class="w-full">
        <div style="background: {{$mainColor[0]}}; transition: all;" class="sm:flex-col md:flex-col flex">
            <div class="art-cropper">
                <img style="border-color: {{$mainColor[1]}}" class="art-artist p-2" src=" {{ $artist->avatar }} " alt="">
            </div>
            <div class="block pt-6 sm:py-4 md:py-4 text-white info">
                <p class="text-3xl"> {{ $artist->name }} </p>
                <p class="text-sm"> {{ $artist->genre }} </p>
                <div class="pt-4 flex">
                    <div class="flex m-auto">
                        <a href="{{ Config::get('app.tw') . '/' . json_decode($artist->social)->twitter }}" @php if
                            (!json_decode($artist->social)->twitter) {
                            echo('class="pointer-events-none cursor-default"');
                            }
                            @endphp target="_blank">
                            <img loading="lazy" src="{{ env('TW') . '/favicon.ico' }}" alt="" class="h-8 w-8 mx-2">
                        </a>
                        <a href="{{ Config::get('constants.IG') . '/' . json_decode($artist->social)->instagram }}" @php if
                            (!json_decode($artist->social)->instagram) {
                            echo('class="pointer-events-none cursor-default"');
                            }
                            @endphp target="_blank">
                            <img loading="lazy" src="{{ Config::get('constants.TW') . '/favicon.ico' }}" alt="" class="h-8 w-8 mx-2">
                        </a>
                    </div>
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
    @includeIf('promotion')
@endsection
@push('head')
@javascript('search', route('search'))
@endpush

@extends('layouts.app')
@section('title', '')
    @includeIf('info.home')
@section('content')
    @php
    $user = Session::get('user');
    @endphp
    <div class="bg-gray-300">
        <div id="home">
            <div class="w-full flex px-8 py-2">
                <button class="ml-auto mr-4 px-4 py-1 switch">switch</button>
            </div>
            <div id="trend"
                class="overflow-x-scroll font-bold whitespace-no-wrap scrolling-auto scrolling-touch sm:p-2 md:p-2 p-4">
                @foreach ($trend as $trend)
                    @if ($trend instanceof App\Tracks)
                        <a
                            href=" {{ route('track', ['id' => $trend->id, 'artist' => $trend->artist, 'title' => $trend->title]) }} ">
                            <div class="inline-block sm:w-40 md:w-48 lg:w-48 xl:w-56 mx-1 shadow-lg hover:shadow-xl">
                                <img loading="lazy"
                                    class="sm:w-40 md:w-48 lg:w-48 xl:w-56 sm:h-40 md:h-48 lg:h-48 xl:h-56 pix"
                                    src=" {{ $trend->art }} " alt="FRONT COVER">
                                <div class="block text-sm sm:w-32 md:w-32 lg:w-40 xl:w-40 py-1">
                                    <p class="overflow-hidden hover:overflow-visible px-2"> {{ $trend->title }}
                                    </p>
                                    <p class="text-left px-2"> {{ $trend->artist }} </p>
                                </div>
                            </div>
                        </a>
                    @else
                        <a
                            href=" {{ route('album', ['id' => $trend->id, 'artist' => $trend->artist, 'album' => $trend->title]) }} ">
                            <div class="inline-block sm:w-40 md:w-48 lg:w-48 xl:w-56 mx-2 mx-1 shadow-lg hover:shadow-xl">
                                <img loading="lazy"
                                    class="sm:w-40 md:w-48 lg:w-48 xl:w-56 sm:h-40 md:h-48 lg:h-48 xl:h-56 pix"
                                    src=" {{ $trend->art }} " alt="FRONT COVER">
                                <div class="block text-sm sm:w-32 md:w-32 lg:w-40 xl:w-40 py-1">
                                    <p class="overflow-hidden hover:overflow-visible px-2"> {{ $trend->title }}
                                    </p>
                                    <p class="text-left px-2"> {{ $trend->artist }} </p>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>

            <div class="h-20 flex justify-between">
                <div class="inline-block">
                    ADS ADS ADS ADS ADS ADS ADS
                </div>
                <div class="inline-block">
                    ADS ADS ADS ADS ADS ADS ADS
                </div>
            </div>

            <div id="wide" class="flex w-full justify-between">
                <div id="list" class="block w-2/6 p-5 pix-lg font-bold">
                    <div id="tracks.home" class="px-2">
                        @php
                        $x=0;
                        @endphp
                        @foreach ($tracks as $track)
                            @php
                            $x++;
                            if ($x%4 == 0) {
                            echo('<div class="h-16 text-center">
                                <p>ADS ADS ADS</p>
                            </div>');
                            }
                            @endphp
                            <a
                                href=" {{ route('track', ['id' => $track->id, 'artist' => $track->artist, 'title' => $track->title]) }}">
                                <div class="input mt-1 w-full h-20 switch flex">
                                    <img loading="lazy" src="{{ $track->art }}"
                                        class="inline-block h-16 w-24 mb-auto mt-auto ml-4">
                                    <div class="h-16 mb-auto mt-auto ml-4 w-full">
                                        <div class="flex justify-between">
                                            <div>
                                                <p> {{ $track->title }} </p>
                                                <p class="mt-auto text-sm text-bold"> {{ $track->artist }} </p>
                                            </div>
                                            <div class="mt-auto text-right">
                                                <p class="text-sm text-teal-500"> {{ $track->duration }} </p>
                                                <p class="text-sm text-blue-500"> {{ $track->genre }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="block w-1/4 h-full px-2">
                    <div class="border-l-2 border-r-2 border-teal-500 h-64 p-4 my-2">
                        <div class="overflow-hidden">
                            <p class="font-mono font-bold text-lg">#Most Download</p>
                            <ul class="py-2">
                                @foreach ($md as $d)
                                    <li class="font-serif my-1">
                                        <a href="" class="flex switch">
                                            <p class="text-left"> {{ $d->title }}</p>
                                            <p class="ml-auto text-right text-sm"> {{ $d->artist }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="h-20">
                        ADS
                    </div>

                    <div class="border-l-2 border-r-2 border-teal-500 shadow-lg hover:shadow-2xl h-64 p-4 my-2">
                        <div class="overflow-hidden">
                            <p class="font-mono">#Recently Added</p>
                            <ul class="py-2">
                                <li class="font-serif my-1">
                                    <a href="" class="flex switch">
                                        Losing Interest - Stello <span class="text-blue-500 ml-auto">genre</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="sideAds" class="block h-full bg-gray-500 w-1/4">

                </div>
            </div>

            <div id="sm" class="flex-col w-full">
                <div id="list" class="block p-5 pix-lg font-bold">
                    <div id="tracks.home" class="px-2">
                        @foreach ($tracks as $track)
                            <a
                                href=" {{ route('track', ['id' => $track->id, 'artist' => $track->artist, 'title' => $track->title]) }}">
                                <div class="input mt-1 w-full h-20 switch flex">
                                    <img loading="lazy" src="{{ $track->art }}"
                                        class="inline-block h-16 w-24 mb-auto mt-auto ml-4">
                                    <div class="h-16 mb-auto mt-auto ml-4 w-full">
                                        <div class="flex justify-between">
                                            <div>
                                                <p> {{ $track->title }} </p>
                                                <p class="mt-auto text-sm text-bold"> {{ $track->artist }} </p>
                                            </div>
                                            <div class="mt-auto text-right">
                                                <p class="text-sm text-teal-500"> {{ $track->duration }} </p>
                                                <p class="text-sm text-blue-500"> {{ $track->genre }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="border-l-2 border-r-2 border-teal-500 h-64 p-4 my-2 w-full">
                    <div class="overflow-hidden">
                        <p class="font-mono font-bold text-lg">#Most Download</p>
                        <ul class="py-2">
                            @foreach ($md as $d)
                                <li class="font-serif my-1">
                                    <a href="" class="flex switch">
                                        <p class="text-left"> {{ $d->title }}</p>
                                        <p class="ml-auto text-right text-sm"> {{ $d->artist }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

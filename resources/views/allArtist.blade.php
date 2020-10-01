@extends('layouts.app')
@section('content')
    <div class="w-full flex">
        <div class="view m-auto overflow-auto bg-black">
            @if ($paginator ?? null)
                @foreach ($paginator as $artist)
                    <a href={{ route('artist', ['name' => $artist->name]) }} class="box">
                    <div style="background: {{$artist->mainColor[1]}}" class="rounded-t-lg">
                            <img src={{ $artist->avatar }} loading="lazy">
                            <div class="w-full p-2 text-center text-blend">
                                {{ $artist->name }}
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
    <div class="b-nav flex">
        <div class="w-1/5 m-auto">
            <ul class="flex justify-between p-4">
                <li>
                    <a href={{$paginator->previousPageUrl()}} class="hover-button"><< Back</a>
                </li>
                <li>
                    <a href={{$paginator->nextPageUrl()}} class="hover-button">Next >></a>
                </li>
            </ul>
        </div>
    </div>
@endsection
@push('head')
    <script src={{ asset('js/app/allArtists.js') }}></script>
    @javascript('search', route('search'))
@endpush

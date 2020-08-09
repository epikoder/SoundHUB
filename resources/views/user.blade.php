@extends('layouts.app')
@section('title', 'home')

@section('content')
    <div class="p-1 block w-4/5 m-auto">
        @if ($artist)
            <div class="w-full h-10 flex px-1">
                <div class="p-px absolute mr-4 right-0 content-center">
                        <a href={{ route('dashboard/artists', ['name'=> $artist->name]) }} class="outline-none bg-blue-500 hover:pointer rounded hover:outline-none right-0 absolute mx-1 px-1 lg:h-8 xl:h-8 md:h-6 sm:h-4 text-bold lg:text-lg xl:text-lg md:text-sm sm:text-xs text-white">
                            Manage
                        </a>
                </div>
            </div>
        @endif
            <div class="lg:h-48 xl:h-48 md:h-40 sm:h-32 w-full m-auto border-r-2 border-b-2 rounded shadow-md flex">
                <div class="lg:h-48 xl:h-48 md:h-40 sm:h-32 lg:w-48 xl:w-48 md:w-40 sm:w-32  bg-gray-100 border-gray-100 border-2 shadow-md">
                    <img src={{$user->avatar_url}} alt="" class="rounded-full lg:h-48 xl:h-48 md:h-40 sm:h-32 lg:w-48 xl:w-48 md:w-40 sm:w-32"/>
                </div>
            </div>
            <div class="w-full bg-white mt-12">
                <div class="h-12 w-full bg-gray-100 rounded-md shadow-md border-t-2 border-blue-500 p-4">
                    <a href="http://example.com">update profile</a>
                </div>
            </div>
        </div>
@endsection

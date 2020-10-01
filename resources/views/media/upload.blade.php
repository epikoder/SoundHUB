@extends('layouts.app')
@section('content')
    @php
    $user = Session::get('user');
    @endphp
    <div class="w-full flex">
        <div
            class="sm:w-5/6 md:w-5/6 lg:w-2/6 xl:w-2/6 m-auto mt-20 px-12 py-8 border border-gray-500 bg-gray-300 rounded-md frame">
            <form class="form" action="{{ route('media.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex-col px-2">
                    <div class="w-full flex input-group border input-bg hover:border-teal-500 rounded-md">
                        <label for="title" class="bg-black text-white px-2">
                            Title<span class="text-red-700">*</span>
                        </label>
                        <input type="text" name="title" class="title w-full px-2 focus:outline-none"
                            placeholder={{ Config::get('app.name') }} required>
                    </div>
                    <div class="flex my-1">
                        <div class="ml-auto border input-group input-bg hover:border-teal-500 rounded">
                            <label for="feat" class="bg-black text-white px-2">
                                Feat
                            </label>
                            <input type="text" name="feat" class="feat px-2 focus:outline-none"
                                placeholder={{ env('APP_NAME_SMALL') }}>
                        </div>
                    </div>
                    <div class="flex-col my-4">
                        <div class="flex my-1">
                            <select name="genre" class="m-auto select">
                                <option value="">select genre</option>
                                @foreach ($genres as $genre)
                                    <option value={{ $genre->id }}>{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex my-1">
                            <input type="text" name="c_genre" class="px-2 m-auto py-1 input-bg" placeholder="set custom">
                        </div>
                    </div>
                    <div class="w-full flex my-2">
                        <input type="file" name="track" id="track" class="inputfile track" accept="audio/*" required>
                        <label for="track"
                            class="m-auto my-2 input-bg text-black border-black border rounded-md px-4 py-1 hover:text-white hover:bg-black">
                            Choose file<span class="text-red-700">*...</span>
                        </label>
                    </div>
                    <div class="w-full flex-col my-2">
                        <div class="flex w-full">
                            <input type="file" name="art" id="art" class="inputfile art"
                                accept="image/png, image/jpeg, image/svg, image/bmp">
                            <label for="art"
                                class="m-auto my-2 input-bg text-black border-black border rounded-md px-2 py-1 hover:text-white hover:bg-black">
                                add art...
                            </label>
                        </div>
                        <div class="w-full flex">
                            <label for="append_art" class="ml-auto">write art to music?</label>
                            <input type="checkbox" name="append_art" class="mr-auto mt-2 mx-1 append_art">
                        </div>

                    </div>
                </div>
                <div class="text-center flex justify-between">
                    <a href="{{ route('dashboard/artists', ['name' => $user->artists->name]) }}"
                        class="h-8 rounded-full my-2 input-bg text-black border-black border px-2 py-1 hover:text-white hover:bg-black">
                        Dashboard
                    </a>
                    <button type="submit"
                        class="submit my-2 input-bg text-black border-black border rounded-full px-2 py-1 hover:text-white hover:bg-black">Upload</button>
                </div>
            </form>
        </div>
    </div>
    @push('head')
        @javascript('login', route('login'))
        <script type="module" src=" {{ asset('/js/app/upload.js') }} "></script>
    @endpush
@endsection

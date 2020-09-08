@extends('layouts.app')
@section('content')
    <div class="sm:w-full md:w-3/4 lg:w-2/4 xl:w-2/4 m-auto rounded p-6 border bg-gray-400">
        <p class="p-2 font-mono text-black text-center text-lg">Upload Album</p>
        <form action=" {{ route('media.bulk') }} " class="w-full" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="font-sans text-lg text-black my-2 bg-white p-3 rounded shadow">
                <p class="p-2">Album Artist :</p>
                <input class="w-2/4 p-1 rounded border-2 border-gray-400" type="text" value=" {{ $artist->name }} "
                    disabled>
            </div>
            <div class="py-2 bg-white my-2 p-3 rounded shadow">
                <p class="px-2">Album Title :</p>
                <input id="title" type="text" name="title"
                    class="border-b-2 input border-gray-600 focus:border-green-400 outline-none px-2 w-2/4" maxlength="80"
                    required>
            </div>

            <div class="py-2 bg-white my-2 p-3 rounded shadow">
                <p class="px-2">Genre :</p>
                <select class="select2 w-1/4" name="genre">
                    <option value="">select genre</option>
                    @foreach ($genres as $genre)
                        <option value=" {{ $genre->id }} ">{{ $genre->name }}</option>
                    @endforeach
                </select> <input
                    class="px-2 py-1  border-gray-600 m-2 outline-none border-2 rounded input focus:border-green-400"
                    type="text" name="c_genre" maxlength="30" placeholder="custom genre">
                <div class="py-2">
                    <input id="art" type="file" name="art" accept="image/png, image/jpeg, image/svg, image/bmp"
                        class="inputfile">
                    <label for="art"
                        class="input-bg text-black border-black border rounded-md px-2 py-1 hover:text-white hover:bg-black">
                        Album Front Cover
                    </label>
                </div>
            </div>

            <div class="p-2 bg-white my-2 p-3 rounded shadow">
                <p class="px-2 font-mono text-lg">Tracks</p>
                <div class="border border-black rounded p-2 tracks">
                    <div class="py-2 t1">
                        <div class="py-2">
                            Title : <input type="text" name="title1"
                                class="border-b-2 input focus:border-green-400 outline-none px-2 w-2/4 m-1" maxlength="80"
                                required><br>
                            Artist :
                            <input class="w-2/4 p-1 rounded border-2 border-gray-400" type="text"
                                value=" {{ $artist->name }} " disabled>
                            <input type="text" name="feat1"
                                class="border-b-2 border-gray-800 input focus:border-green-400 outline-none px-2 w-2/4 m-1"
                                maxlength="80" placeholder="Feat">
                        </div>
                        <div>
                            <input type="checkbox" checked disabled>
                            <input type="hidden" name="check1" id="check1" value="1" readonly>
                            <input id="track1" type="file" name="track1" accept="audio/*"
                                class="inputfile" required>
                            <label for="track1"
                                class="input-bg text-black border-black border rounded-md mx-2 px-2 py-1 hover:text-white hover:bg-black">
                                Choose file...
                            </label>
                        </div>
                    </div>
                    <div class="py-2 t2">
                        <div class="py-2">
                            Title : <input type="text" name="title2"
                                class="border-b-2 input focus:border-green-400 outline-none px-2 w-2/4 m-1" maxlength="80"
                                required><br>
                            Artist :
                            <input class="w-2/4  p-1 rounded border-2 border-gray-400" type="text"
                                value=" {{ $artist->name }} " disabled>
                            <input type="text" name="feat2`"
                                class="border-b-2 border-gray-700 input focus:border-green-400 outline-none px-2 w-2/4 m-1"
                                maxlength="80" placeholder="Feat">
                        </div>
                        <div>
                            <input type="checkbox" checked disabled>
                            <input type="hidden" name="check2" id="check2" value="1" readonly>
                            <input id="track2" type="file" name="track2" accept="audio/*"
                                class="inputfile" required>
                            <label for="track2"
                                class="input-bg text-black border-black border rounded-md mx-2 px-2 py-1 hover:text-white hover:bg-black">
                                Choose file...
                            </label>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <button class="input-bg text-black border-black border rounded-full mx-2 p-1 w-8 hover:text-white hover:bg-black text-lg add">+</button>
                    <button class="input-bg text-black border-black border rounded-full mx-2 p-1 w-8 hover:text-white hover:bg-black text-lg remove">-</button>
                </div>
            </div>
            <div>
                <div class="progress my-2">
                    <div class="bar"></div>
                    <div class="percent">0%</div>
                </div>
                <div class="flex justify-between text-black ">
                    <a href={{route('dashboard/artists', ['name'=> $artist->name])}} class="cancel input-bg border-black border rounded-full mx-2 px-2 py-1 hover:text-white hover:bg-black">Dashboard</a>
                    <button type="submit" class="submit input-bg border-black border rounded-full mx-2 px-2 py-1 hover:text-white hover:bg-black">Upload</button>
                </div>
            </div>
        </form>
    </div>
    @push('head')
        @javascript('artist', $artist->name)
        <script src={{ asset('js/app/bulk.js') }} type="module"></script>
    @endpush
@endsection

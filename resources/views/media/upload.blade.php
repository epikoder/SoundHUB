@extends('layouts.app')
@section('content')
<div class="w-full flex pt-4">
    <div class="sm:w-3/4 md:w-2/4 lg:w-2/4 xl:w-2/4 m-auto border-2 p-4">
        <button onclick="close()" class="cursor-pointer">
            <img class="w-3 h-3" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyLjAwMSA1MTIuMDAxIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIuMDAxIDUxMi4wMDE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxnPg0KCQk8cGF0aCBkPSJNMjg0LjI4NiwyNTYuMDAyTDUwNi4xNDMsMzQuMTQ0YzcuODExLTcuODExLDcuODExLTIwLjQ3NSwwLTI4LjI4NWMtNy44MTEtNy44MS0yMC40NzUtNy44MTEtMjguMjg1LDBMMjU2LDIyNy43MTcNCgkJCUwzNC4xNDMsNS44NTljLTcuODExLTcuODExLTIwLjQ3NS03LjgxMS0yOC4yODUsMGMtNy44MSw3LjgxMS03LjgxMSwyMC40NzUsMCwyOC4yODVsMjIxLjg1NywyMjEuODU3TDUuODU4LDQ3Ny44NTkNCgkJCWMtNy44MTEsNy44MTEtNy44MTEsMjAuNDc1LDAsMjguMjg1YzMuOTA1LDMuOTA1LDkuMDI0LDUuODU3LDE0LjE0Myw1Ljg1N2M1LjExOSwwLDEwLjIzNy0xLjk1MiwxNC4xNDMtNS44NTdMMjU2LDI4NC4yODcNCgkJCWwyMjEuODU3LDIyMS44NTdjMy45MDUsMy45MDUsOS4wMjQsNS44NTcsMTQuMTQzLDUuODU3czEwLjIzNy0xLjk1MiwxNC4xNDMtNS44NTdjNy44MTEtNy44MTEsNy44MTEtMjAuNDc1LDAtMjguMjg1DQoJCQlMMjg0LjI4NiwyNTYuMDAyeiIvPg0KCTwvZz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
        </button>
        <form action={{route('media.upload')}} method="POST" enctype="multipart/form-data" class="px-4">
            <div class="text-center flex-col my-2">
                @csrf
                <label for="title">Title</label>
                <input type="text" name="title" class="w-full px-2 my-1 input outline-none border-b-2 focus:border-green-300 text-center">
                <div id="addon"></div>

                <input type="file" name="track" class="text-center outline-none">
            </div>
            <div class="flex justify-center">
                <select name="list" id="select" class="m-1 mx-2 outline-none border-2">
                    <option value="year">Year</option>
                    <option value="art">Cover Art</option>
                </select>
                <p onclick="add()" class="cursor-pointer p-1 outline-none bg-blue-500 text-sm text-white rounded-md">Add</p>
            </div>

            <button type="submit" onclick="submit()">Upload</button>
        </form>
    </div>
</div>
<script>
    var s = [];
    $(document).ready(function(){
        window.NP.done();
        if("{{$message ?? ''}}") {
            alert("{{$message ?? ''}}")
        }
    })
    function add() {
        var v = $('#select').val();
        var sv = s.values();
        for (x of sv) {
            if (x == v) {
                return false;
            }
        }
        s.push(v);
        if (v == 'year') {
            $('#addon').append(
                '<input name="year" type="number" value="<?php echo(date("Y")); ?>" class="text-center outline-none border-b-2 input focus:border-green-300">'
            );
        }
        if (v == 'art') {
            $('#addon').append(
                `<input name="art" type="file" class="text-center outline-none w-full">
                <div class="w-full text-left"><input type="checkbox" name="write" class="text-center"><span class="text-sm">change default art?</span></div>`
            );
        }
        return true;
    }
    function close() {
        location.assign("{{ route('dashboard/artists',['name' => $artist->name]) }}");
    }
    $(document).on('submit', 'form', function () {
        window.NP.start()
    })
</script>
<style>
    input {
        margin: 5px;
        padding-left: 1rem;
        padding-right: 1rem;
    }
</style>
@endsection

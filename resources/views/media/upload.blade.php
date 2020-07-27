@extends('layouts.app')
@section('content')
<div class="w-full flex pt-4">
    <div class="sm:w-3/4 md:w-2/4 lg:w-2/4 xl:w-2/4 m-auto border-2 p-4">
        <form action={{route('media.upload')}} method="POST" enctype="multipart/form-data" class="px-4">
            <div class="text-center flex-col">
                @csrf
                <label for="title">Title</label>
                <input type="text" name="title" class="w-full px-2 my-1 input outline-none border-b-2 focus:border-green-300 text-center">
                <div id="addon"></div>

                <label for="track" class="w-full">Upload song<span class="text-red-300">*</span></label><br>
                <input type="file" name="track" class="text-center outline-none">
            </div>
            <div class="flex justify-center">
                <select name="list" id="select" class="m-1 mx-2 outline-none border-2">
                    <option value="year">Year</option>
                    <option value="art">Cover Art</option>
                </select>
                <p onclick="add()" class="cursor-pointer">add</p>
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
                <input type="checkbox" name="write" class="text-center"><span class="text-sm">change default art?</span>`
            );
        }
        return true;
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

@extends('layouts.app')
@section('title', '')

@section('content')
<div>
    <div>
        <div id="trend" class="border-2 m-auto">
            <p>#Trends</p>
            <div class="flex w-full sm:h-40">
                <div class="sm:w-32 m-1">
                    <img src={{asset('img/avatar.png')}} class="sm:h-32 w-32 rounded" alt="">
                    <p class="text-right text-sm">{{json_decode($_COOKIE['SoundHUB'])->artist->name}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        window.NP.done();
    })
</script>
@endsection

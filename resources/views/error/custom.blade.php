@extends('layouts.app')
@section('title', {{$code}})

@section('content')
    <div class="ml-2/4 bg-white mt-56 flex">
        <h1 class="text-5xl font-sans text-gray-700">{{$code}}</h1>
        <p class="text-gray-700 opacity-75">{{$text}}</p>
    </div>
@endsection

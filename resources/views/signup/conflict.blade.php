@extends('layouts.app')
@section('title', '| signup')

@section('content')
    <div class="p-20 bg-gray-400 text-white font-serif">
        <p>Account exist already</p>
        <p>Please login <a href="{{route('login')}}">here</a></p>
    </div>
@endsection

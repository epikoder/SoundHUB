@extends('layouts.app')
@section('title', '| signup')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="w-full items-center h-48 p-2 rounded">
        <h1 class="text-white text-xl bg-blue-500 px-2 rounded">Registration Successful</h1>
        <p class="bg-blue-500 text-white font-sans rounded px-2 mt-1">
            {{$response->name}}, instructions on how to complete the registration <br>
             have been sent to {{$response->email}}
        </p>
    </div>
@endsection

@extends('layouts.app')
@section('title', '| signup')

@section('content')
    <div class="w-2/4 ml-1/4 mr-2/4 h-60 mt-20 p-4 rounded border-2">
        <div class="p-2">
            <p class="text-lg">Welcome {{$user->name}}</p>
            <p>Let's create password for your account</p>
            <p class="text-sm text-gray-500">password should be atleast six characters</p>
        </div>
        <div class="p-2">
            <form name="form" action={{route('signup.main')}} method="POST">
                @csrf
                <input id="id" type="hidden" name="id" value={{$user->id}}>
                <input id="token" type="hidden" name="token" value={{$user->token}}>

                <label>password <span class="text-red-300">*</span></label>
                <div id="div-p" class="w-full border-b-2 hover:border-green-300">
                    <input id="p" type="password" name="" class="w-full outline-none" required>
                </div>

                <label>confirm password <span class="text-red-300">*</span></label>
                <div id="div-cp" class="w-full border-b-2 hover:border-green-300">
                    <input id="cp" type="password" name="" class="w-full outline-none" required>
                </div>
                <div class="flex w-full">
                    <button type="submit" class="bg-blue-500 ml-auto m-1 text-black p-1 w-16 focus:outline-none">submit</button>
                </div>
            </form>
        </div>
    </div>
    <script type="module" src={{asset('js/signup.js')}}></script>
@endsection

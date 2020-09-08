@extends('layouts.app')
@section('title', '| signup')

@section('content')
    @javascript('route', route('plans'))
    @php
    $signup = Session::get('signup')
    @endphp
    <div class="flex">
        <div class="m-auto mt-10 sm:w-3/4 md:w-3/4 lg:w-2/4 xl:w-2/4 p-8 border-2 border-gray-700 rounded-lg">
            <div class="">
                <p class="text-xl py-2">Welcome {{ $signup->name }}</p>
                <p>Let's create a password for your account</p>
                <p class="text-sm text-gray-500">password should be atleast six characters</p>
            </div>
            <div class="py-4">
                <form name="form" action={{ route('signup.main') }} method="POST">
                    @csrf
                    <input id="id" type="hidden" name="id" value={{ $signup->id }}>
                    <input id="token" type="hidden" name="token" value={{ $signup->token }}>

                    <div class="w-full border-b-2 hover:border-teal-500 py-2 div-p">
                        <label>password <span class="text-red-600">*</span></label>
                        <input type="password" name="password" class="w-full outline-none password" required>
                    </div>

                    <div class="w-full border-b-2 hover:border-teal-500 py-2 div-cp">
                        <label>confirm password <span class="text-red-600">*</span></label>
                        <input type="password" name="c-password" class="w-full outline-none c-password" required>
                    </div>
                    <div class="flex w-full">
                        <button type="submit"
                            class="my-2 input-bg text-black border-black border-2 focus:outline-none rounded-full px-2 py-2 ml-auto mr-4 hover:text-white hover:bg-black">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="module" src={{ asset('js/signup.js') }}></script>
@endsection

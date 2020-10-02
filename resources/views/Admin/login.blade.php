@extends('Admin.layouts.appx')

@section('content')
<div class="bg-gray-200 w-full">
        <div class="flex py-12">
            <form name="form" action={{ route('login.admin') }} method="post"
                class="m-auto sm:w-5/6 md:w-3/4 lg:w-2/4 xl:w-1/4 p-8 bg-white border border-gray-600 rounded">
                <div class="flex py-2">
                    <img loading="lazy" src={{ asset('favicon.ico') }} class="m-auto h-10 w-10">
                </div>
                @csrf
                <div class="block p-4">
                    <input type="email" name="email"
                        class="email w-full border-b border-gray-600 focus:border-teal-500 hover:border-teal-500 input focus:outline-none my-2 p-1"
                         required>
                    <div class="flex border-b border-gray-600 focus:border-teal-500 hover:border-teal-500 input">
                        <input type="password" name="password"
                            class="password w-full focus:outline-none p-1"
                            required>
                        <small class="px-1 eye eye-open cursor-pointer">Show</small>
                    </div>
                    <button type="submit"
                        class="submit my-1 input-bg text-black text-sm border-black border rounded-full px-2 hover:text-white hover:bg-black">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('title', 'login')

@section('content')
    <div class="bg-gray-200 h-f w-full">
        <div class="flex py-12">
            <form name="form" action={{ route('login') }} method="post"
                class="m-auto sm:w-5/6 md:w-3/4 lg:w-2/4 xl:w-1/4 p-8 bg-white border border-gray-600 rounded">
                <div class="flex">
                    <img loading="lazy" src={{ asset('favicon.ico') }} class="m-auto h-10 w-10">
                </div>
                @csrf
                <div class="block p-4">
                    <input type="email" name="email" class="email w-full border-b border-gray-600 focus:border-teal-500 hover:border-teal-500 input focus:outline-none my-2 p-1" placeholder="johndoe@domain.com" required>
                    <div class="flex">
                        <input type="password" name="password" class="password w-full border-b border-gray-600 focus:border-teal-500 hover:border-teal-500 input focus:outline-none my-2 p-1" placeholder="*********" required>
                        <small class="my-2 px-1 eye eye-open cursor-pointer">Show</small>
                    </div>
                    <button type="submit"
                        class="submit my-2 input-bg text-black border-black border rounded-full px-2 py-1 hover:text-white hover:bg-black">Login</button>
                </div>
            </form>
        </div>
    </div>
    @push('head')
        <script type="module" src="/js/app/login.js"></script>
    @endpush
@endsection

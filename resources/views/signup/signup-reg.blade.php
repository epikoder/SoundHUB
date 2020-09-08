@extends('layouts.app')
@section('title', '| signup')

@section('content')
    @javascript('route', route('signup/res'))
    <div class="w-full flex">
        <div class="sm:w-5/6 md:w-5/6 lg:w-2/6 xl:w-2/6 m-auto mt-24 px-12 py-8 border-2 rounded-md frame">
            <div class="info my-2 p-4">
                @includeIf('signup.info')
            </div>
            <form class="form" action="{{ route('signup.reg') }}" method="post">
                @csrf
                <div class="border-b-2 border-gray-500 hover:border-teal-500 input mt-2">
                    <label for="name" class="text-lg font-mono font-bold">Username:</label>
                    <input type="text" name="name" class="name w-full outline-none px-2" required>
                </div>
                <small class="name_error text-blue-500 text-sm italic">must be six letters without space</small>

                <div class="border-b-2 border-gray-500 hover:border-teal-500 input mt-2">
                    <label for="email" class="text-lg font-mono font-bold">Email:</label>
                    <input type="email" name="email" class="email w-full outline-none px-2" required>
                </div>
                <small class="email_error text-blue-500 text-sm italic">enter a valid email</small>

                <div class="text-center block">
                    <button type="submit"
                        class="my-2 input-bg text-black border-black border-2 focus:outline-none rounded-full px-2 py-1 hover:text-white hover:bg-black">Submit</button>
                    <a href="{{ route('login') }}">
                        <p class="text-sm my-2 hover:text-blue-500 font-sans font-bold">Already have an account ?</p>
                    </a>
                </div>
            </form>
        </div>
    </div>
    @push('head')
        <script type="module" src=" {{ asset('js/app/regs.js') }} "></script>
    @endpush
@endsection

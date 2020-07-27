@extends('layouts.app')
@section('title', '| signup')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="lg:hidden xl:hidden">
        <div>
            <form action="{{ route('signup.reg') }}" method="post">
                @csrf
                <label for="name">username</label>
                <div class="border-b-2 hover:border-green-300 input">
                    <input type="text" name="name" class="w-full outline-none">
                </div>

                <label for="email">email</label>
                <div class="border-b-2 hover:border-green-300 input">
                    <input type="email" name="email" class="w-full outline-none">
                </div>

                <button type="submit">Submit</button>
            </form>
        <a href="{{ env('APP_URL').'login'}}">Already have an account?</a>
        </div>
    </div>
@endsection

@extends('layouts.mail')
@section('title', 'signup')
@section('content')
    <div class="text-center p-2">
        <h1>Hello {{ $signup->name }}</h1>
        <p>
            Thank you for choosing {{ Config::get('app.name') }}, we are delighted to bring to have you. <br> Please click
            the
            link below
            to continue your registeration.

            this is test response
        </p>
        <p><a href="{{ route('signup.ver') . '/?id=' . $signup->id . '&' . 'token=' . $signup->token }}">
                <button class="p-1 bg-blue-500 text-white rounded">
                    Complete Signup
                </button>
            </a>
        </p>
    </div>
@endsection

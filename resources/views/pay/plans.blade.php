@extends('layouts.app')
@section('title', 'plans')

@section('content')
    <div class="block">
        <div class="m-auto flex-wrap p-4">
            <img src="" alt="" class="h-68">
        </div>
        @if (!$user->artists)
            <div class="ml-16">
                <h1>{{ Config::get('app.name') }} Artists</h1>
                <blockquote>
                    upload
                </blockquote>
            </div>
        @endif
    </div>
@endsection

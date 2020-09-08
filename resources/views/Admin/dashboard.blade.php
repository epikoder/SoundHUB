@extends('Admin.layouts.app')

@section('content')
    <div class="">
        @javascript('users', Session::get('users'))
        @javascript('artists', Session::get('artists'))

        <div class="flex justify-between py-2">
            @if (Cookie::get('XS-ADMIN'))
                <div class="flex-1 pills mx-2 h-68 py-4 shadow-xl">
                    <canvas class="users"></canvas>
                </div>
            @endif
            <div class="flex-1 pills mx-2 h-64 shadow-2xl songs"></div>
            <div class="flex-1 pills mx-2 h-64 shadow-xl albums"></div>
            <div class="w-1/12 pills h-64 shadow-xl clock"></div>
        </div>

        <div class="flex justify-between py-2">
            <div class="flex-1 pills mx-2 h-64  shadow-xl"></div>
            <div class="flex-1 pills mx-2 h-64  shadow-xl"></div>
            <div class="flex-1 pills mx-2 h-64  shadow-xl"></div>
        </div>
        <div class="flex justify-between py-2">
            <div class="flex-1 pills mx-2 h-64  shadow-xl"></div>
            <div class="flex-1 pills mx-2 h-64  shadow-xl"></div>
            <div class="flex-1 pills mx-2 h-64  shadow-xl"></div>
        </div>

        @push('head')
            <script src={{ asset('js/admin/dashboard.js') }} type="module"></script>
        @endpush

    </div>
@endsection

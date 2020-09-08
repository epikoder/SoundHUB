@extends('layouts.app')
@section('content')
<div class="sm:w-full md:w-3/4 lg:w-2/4 xl:w-2/4 flex w-full bg-gray-100">
    <form action={{route('.setup')}} method="post" class="m-auto mt-12 p-4 border bg-white">
        <h1 class="p-4"><strong>Let's set up name for your account</strong></h1>
        <p class="p-4">
            {{env('APP_NAME')}} uses unique name to identify artists,<br>
             one name cannot be used by more than one account, if your <br>
             artist name is already in use and your artist name is recognised <br>
             please contact our support to help retrive your name
        </p>
        <div class="p-4 w-full block">
            @csrf
            <div class="border-b border-black input hover:border-teal-500">
                <input type="text" name="name" class="focus:outline-none py-1 w-full px-4 input-bg name">
            </div>
            <strong><small class="ml-auto message text-right px-4">enter a name</small></strong>
        </div>
        <div class="flex">
        <button type="submit" class="submit ml-auto input-bg border-black border rounded-full mx-2 px-2 py-1 hover:text-white hover:bg-black">Continue</button>
        </div>
    </form>
</div>
@push('head')
@javascript('query', route('queryName'))
<script src={{asset('js/app/setup.js')}} type="module"></script>
@endpush
@endsection

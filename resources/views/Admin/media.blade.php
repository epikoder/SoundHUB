@extends('Admin.layouts.app')

@section('content')
    <div>
        <div class="text-lg border-b-2 border-l-2 px-2">
            <ul>
                <li id="home" class="px-12 p-2 inline-block  hover:text-blue-500 cursor-pointer">
                    <p>Home</p>
                </li>
                <li id="upload" class="px-12 p-2 inline-block hover:text-blue-500 cursor-pointer">
                    <p>Upload</p>
                </li>
                <li id="al-upload" class="px-12 p-2 inline-block hover:text-blue-500 cursor-pointer">
                    <p>Upload Album</p>
                </li>
                <li id="manage" class="px-12 p-2 inline-block hover:text-blue-500 cursor-pointer">
                    <p>Manage</p>
                </li>
            </ul>
        </div>
        <div id="content" class="flex p-6">
        </div>
    </div>
@endsection
@push('head')
@javascript('homeUrl', route('media.links', ['path' => 'home']))
@javascript('uploadUrl', route('media.links', ['path' => 'upload']))
@javascript('albumUrl', route('media.links', ['path' => 'al-upload']))
@javascript('manageUrl', route('media.links', ['path' => 'manage']))
<script type="module" src={{asset('js/admin/media.js')}}></script>
<link rel="stylesheet" href={{asset('css/select2.min.css')}}>
@endpush

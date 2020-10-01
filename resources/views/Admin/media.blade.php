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
    <script type="module">
        var tab = '#home';
        $('#home').on('click', function() {
            NP.start();
            rc(tab, '#home');
            $('#content').load('/media.home', function() {
                NP.done();
            });
        });
        $('#upload').on('click', function() {
            NP.start();
            rc(tab, '#upload');
            $('#content').load('/media.upload', function() {
                NP.done();
                $('.select2').select2();
            });

        });
        $('#al-upload').on('click', function() {
            NP.start();
            rc(tab, '#al-upload');
            $('#content').load('/media.al-upload', function() {
                NP.done();
                $('.select2').select2();
            });
        });
        $('#manage').on('click', function() {
            NP.start();
            rc(tab, '#manage');
            $('#content').load('/media.manage', function() {
                NP.done();
            });

        });

        function rc(x, y) {
            $(x).removeClass('text-blue-500');
            $(y).addClass('text-blue-500');
            tab = y;
        }

        $(function() {
            $('#media').addClass('bg-gray-900 text-white');
            $('#home').addClass('text-blue-500');
            $('#content').load('/media.home', function() {
                NP.done();
            });
        });

    </script>
@endsection

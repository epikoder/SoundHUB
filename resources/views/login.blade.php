@extends('layouts.app')
@section('title', 'login')

@section('content')
<div id="alert" class="flex w-full align-middle content-center items-center justify-center">
    <div class="flex text-center mx-auto w-1/4 bg-white px-12 border-2 border-gray-300 text-red-300">

    </div>
</div>
<div>
    <div>
        <form name="form" action={{route('login')}} method="post">
            @csrf
            <input id="email" type="email" name="email" required>
            <input id="password" type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</div>
<script type="module">
    import { vi, sc, gc, boot } from '/js/app.js';
    var c = boot ();
    $(document).ready(function (){
        window.NP.done();
    })
    $(document).on('submit', 'form', function (e) {
        e.preventDefault();
        window.NP.start();
        var url = $('form').attr('action');
        var form = new FormData($('form').get(0));
        axios.post(url, form)
            .then((response) => {
                c.user = response.data.user;
                c.artist = response.data.artist;
                c.media = response.data.media;
                sc(c);
                location.assign('/'.concat(c.user.name, '/home'));
            })
            .catch((error) => {
                if (error) {
                    window.NP.done();
                    console.log(error);
                    $('#alert').show();
                }
            });
    })
</script>
@endsection
@extends('layouts.app')
@section('content')
<div>
    <form action={{ route('devlogin') }} method="POST">
        @csrf
        <input type="email" name="email" >
        <br>
        <input type="password" name="password">
        <button type="submit">submit</button>
    </form>
</div>

@endsection

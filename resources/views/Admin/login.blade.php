@extends('Admin.layouts.appx')

@section('content')
<div>
    <div>
        <form action="{{ route('login.admin') }}" method="post">
            <input type="email" name="email">
            <input type="password" name="password" id="">
            <button type="submit">submit</button>
        </form>
    </div>
</div>
@endsection

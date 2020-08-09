@extends('Admin.layouts.appx')

@section('content')
<div>
    <div>
        <form action="{{ route('login.admin') }}" method="post">
            <input type="email">
        </form>
    </div>
</div>
@endsection

@php
    $signup = Session::get('signup');
@endphp
<div>
    {{$signup->email}}
</div>

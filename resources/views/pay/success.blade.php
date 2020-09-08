@extends('layouts.app')
@section('content')
<div>
    <h1><strong>Payment successful</strong></h1>
    <p><a href={{route('setup')}} class="h-12 p-2 bg-white hover:bg-black hover:text-white text-black rounded-full input-bg ">Setup artist account</a></p>
</div>
@endsection

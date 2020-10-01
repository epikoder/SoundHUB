@extends('layouts.app')
@section('title', '| Pay')
@section('content')
    @php
    $plan = Session::get('plan');
    @endphp
    <div class="block bg-blue-500 py-12 w-full">
        @if ($user ?? null)
            @if ($user->artists && $user->artists->active == 1)
                <div class="flex">
                    <div class="m-auto p-12 text-center border-2 border-black b-rounded">

                    </div>
                </div>
            @else
                <div class="flex">
                    <div
                        class="m-auto sm:w-3/4 md:w-2/4 lg:w-1/4 xl:w-1/4 pt-4 bg-black text-white text-center border-2 border-black b-rounded">
                        <div>
                            <img src="" alt={{ Config::get('app.name') }} class="m-auto">
                        </div>
                        <div class="py-4 px-2 text-white flex-col b-rounded bg-teal-900">
                            <form action={{ route('paystack.pay') }} method="post">
                                @csrf
                                <div class="w-full -2">
                                    <label for="order"><strong class="text-4xl">{{ $plan->name }}</strong></label>
                                    <input type="hidden" name="plan" value={{ $plan->code }}>
                                    <input type="hidden" name="amount" value={{ $plan->price }}>
                                    <input type="hidden" name="currency" value="USD">
                                    <input type="hidden" name="email" value={{ $user->email }}>
                                    <input type="hidden" name="reference" value={{ Paystack::genTranxRef() }}>
                                    <p><strong class="text-2xl">${{ $plan->price }}/yr</strong></p>
                                </div>
                                <div class="features py-8 font-mono">
                                    <ol>
                                        <li>
                                            <strong>Unlimited Upload</strong>
                                        </li>
                                        <li>
                                            <strong>Full album / Ep upload</strong>
                                        </li>
                                        <li>
                                            <strong>1 week promoting on new song</strong>
                                        </li>
                                        <li>
                                            <strong>Artists page + Social handle <a href=""
                                                    class="text-sm text-green-400">see</a></strong>
                                        </li>
                                    </ol>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="b-rounded px-3 py-1 hover:bg-black bg-white hover:text-white text-black input-bg focus:outline-none">
                                        <strong>
                                            Pay Now
                                        </strong>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @else
            Must be logged in
        @endif
    </div>
@endsection

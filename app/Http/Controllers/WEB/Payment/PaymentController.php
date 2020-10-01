<?php

namespace App\Http\Controllers\WEB\Payment;

use App\Http\Controllers\WEB\Auth\AuthFacade;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessPayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Unicodeveloper\Paystack\Facades\Paystack;



class PaymentController extends Controller
{
    use AuthFacade, PayFacade;

    public function redirectToGateWay(Request $request)
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $paymentDetails = json_decode(json_encode($paymentDetails));
        if (!$paymentDetails->status || ($paymentDetails->data->status != 'success')) {
            // failed
        }

        $user = $this->user($paymentDetails->data->customer->email);
        $plan = $this->plan($paymentDetails->data->plan_object);
        if (!$user || !$plan) {
            // no user or invalid tranx
        }
        ProcessPayments::dispatch($paymentDetails->data, $plan, $user);
        Session::put('user', $user);
        Session::put('plan', $plan);

        return view('pay.success');
    }
}

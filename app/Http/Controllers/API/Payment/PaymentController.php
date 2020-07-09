<?php

namespace App\Http\Controllers\API\Payment;

use App\Http\Controllers\API\Auth\AuthFacade;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessPayments;
use App\Payments;
use App\Plans;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;



class PaymentController extends Controller
{
    use Objectify, AuthFacade, PayFacade;

    public function redirectToGateWay ()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $paymentDetails = $this->objectify($paymentDetails);
        if (!$paymentDetails->status || ($paymentDetails->data->status != 'success')) {
            return response()->json([], 400);
        }

        $user = $this->user($paymentDetails->data->customer->email);
        $plan = $this->plan($paymentDetails->data->plan_object);
        if (!$user || !$plan) {
            dd(!$user, !$plan);
            return response()->json([], 401);
        }
        ProcessPayments::dispatch($paymentDetails->data->reference, $plan, $user);
        return response()->json();
    }

    public function pla (Request $request)
    {
        $paymentDetails = Payments::find(1);
        dd(Payments::where('reference', $paymentDetails->reference)->first());
    }
}

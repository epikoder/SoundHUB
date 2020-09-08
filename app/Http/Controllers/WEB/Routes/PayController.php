<?php

namespace App\Http\Controllers\WEB\Routes;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MediaQuery;
use App\Http\Controllers\WEB\Payment\PayFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PayController extends Controller
{
    use PayFacade;

    public function plans (Request $request)
    {
        $user = $request->user();


        Session::put('user', $user);
        Session::put('plans', $this->getPlans());
        return view('pay.plans', [
            'data' => $user
        ]);
    }
}

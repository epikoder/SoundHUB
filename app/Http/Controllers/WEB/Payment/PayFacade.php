<?php
namespace App\Http\Controllers\WEB\Payment;

use App\Models\Plans;

trait PayFacade
{
    public function plan ($plan_object)
    {
        return Plans::where('name', $plan_object->plan_code)->first();
    }

    public function getPlanWithId($id = 1)
    {
        return Plans::find($id);
    }

    public function getPlans ()
    {
        return Plans::all();
    }
}

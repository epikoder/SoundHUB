<?php
namespace App\Http\Controllers\API\Payment;

use App\Plans;

trait PayFacade
{
    public function plan ($plan_object)
    {
        return Plans::where('name', $plan_object->plan_code)->first();
    }
}
?>

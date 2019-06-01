<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakePaymentRequest;
use Illuminate\Support\Facades\Request;
use Softon\Indipay\Facades\Indipay;

class CcavenueController extends Controller
{
    //
    public function makePayment(MakePaymentRequest $request)
    {

        //
        /* All Required Parameters by your Gateway */
        $parameters = [
            'tid' => '1233221223322',
            'order_id' => '1232212',
            'amount' => '1200.00',
        ];

        $order = Indipay::gateway('CCAvenue')->prepare($parameters);
        return Indipay::process($order);
    }

    public function response(Request $request)
    {

        // For Otherthan Default Gateway
        $response = Indipay::gateway('CCAvenue')->response($request);

        dd($response);

    }

}

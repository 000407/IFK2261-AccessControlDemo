<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentsController extends Controller
{
    public function process(Request $request)
    {
    	$expiry = explode('/', $request->input('cardExpiration'));

    	$pgwPayload = [
    		"app_name" => "AccessControlDemo",
		    "service" => "e Commerce",
		    "customer_email" => $request->input('email'),
		    "card_type" => $request->input('cardType'),
		    "card_holder_name" => $request->input('nameOnCard'),
		    "card_number" => $request->input('cardNumber'),
		    "expiryMonth" => $expiry[0],
		    "expiryYear" => $expiry[1],
		    "cvv" => $request->input('cardCvv'),
		    "amount" => "5000.00", // This should be obtained from the order ID
		    "currency" => "LKR" // This should be obtained from the order ID
    	];

    	$paymentUrl = config('pgw.url').'/api/v1/payment/card';

    	$response = Http::post($paymentUrl, $pgwPayload);

        return view(
        	'orders.checkout_status', 
        	[
        		'paymentStatus' => $response->status()
        	]
        );
    }
}

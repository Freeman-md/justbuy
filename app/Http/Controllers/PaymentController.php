<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;
use Cart;

class PaymentController extends Controller
{
    public function redirectToGateway() {

        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            session()->flash('error', 'The paystack token has expired. Please refresh the page and try again.');
            return redirect()->back();
        }    

    }
    public function handleGatewayCallback() {
        $paymentDetails = Paystack::getPaymentData();

        session()->flash('success', 'Your payment has been confirmed successfully.');
        Cart::destroy();
        return redirect(route('user-orders'));
    }
}

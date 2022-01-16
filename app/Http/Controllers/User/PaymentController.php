<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Stripe;
use Session;

class PaymentController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
    }

    public function makePayment(Request $request){
        Stripe\Stripe::setApiKey('sk_test_51HuylYEcUvyzDfScIZ2KU1cxJotdnYLrhKxLrwTJDV1kV4TkvPxlcb9KmrmGE0tMtsjvoDqxD0aNjS3p2sx6hd2q006oLr5q91');
        $charge = Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "Make payment and chill."
        ]);

        if($charge['status'] == 'succeeded'){

            $pruchase = new Purchase;
            $pruchase->stripe_id = $charge['id'];
            $pruchase->user_id = \Auth::user()->id;
            $pruchase->course_id = $request->course_id;
            $pruchase->total_price = $charge->amount;

            if($charge['refunded']){
                $pruchase->refund_payment = now();
            }else{
                $pruchase->approved_payment = now();
            }

            $pruchase->save();

            Session::flash('success', 'تمت عملية الشراء بنجاح.');
        }else{
            Session::flash('success', 'لم تتم عملية الشراء.');
        }
        return back();
    }
}

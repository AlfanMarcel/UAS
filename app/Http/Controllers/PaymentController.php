<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function show($id){
        $paymentcheck = Payment::where('orderdetail_id', $id)->paginate(6);
        // dd($paymentcheck);
        return view('dashboard.user.UserCheckPayment',[
            'paymentcheck' => $paymentcheck
        ]);
    }
}

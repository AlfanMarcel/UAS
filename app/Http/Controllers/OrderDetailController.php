<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userHistory()
    {
        $users = OrderDetail::with('user')->where('user_id', Auth::user()->id)->paginate(10);

        return view('dashboard.user.history', [
            'users' => $users
        ]);
    }

    public function checkUserPayment()
    {
        $users = OrderDetail::with('user')->paginate(10);
        // dd($users);
        return view('dashboard.user.payment', [
            'users' => $users
        ]);
    }

    public function changeStatusPayment($id)
    {
        $order = OrderDetail::with('user')->where('id', $id)->first();
        $order->status = 1;

        $order->save();
        return redirect()->route('payment.check')->with('success', 'Payment Berhasil dirubah');
    }


    public  function createUploadPembayaran($id)
    {
        $orderdetail = OrderDetail::where('id', $id)->first();

        return view('dashboard.user.buktiPembayaran', [
            'orderdetail' => $orderdetail
        ]);
    }

    public function uploadPembayaran(Request $request)
    {

        $validatedData = $request->validate([
            'orderdetail_id' => 'required',
            'nama' => 'required',
            'bankasal' => 'required',
            'banktujuan' => 'required'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        Payment::create($validatedData);

        return redirect()->route('payment.history')->with('success', 'Success Melakukan Pembayaran');
    }
    public function cetak_pdf()
    {

        $users = OrderDetail::with('user')->where('user_id', Auth::user()->id)->get();
        // dd($users);
        $pdf = PDF::loadView('dashboard.user.historyPdf', [
            'users' => $users
        ]);
        return $pdf->stream();
    }

    public function cetak_pdf_payment()
    {

        $users = OrderDetail::with('user')->get();
        // dd($users);
        $pdf = PDF::loadView('dashboard.user.paymentPdf', [
            'users' => $users
        ]);
        return $pdf->stream();
    }
}

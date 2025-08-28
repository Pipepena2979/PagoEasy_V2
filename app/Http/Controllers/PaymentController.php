<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userss;

class PaymentController extends Controller
{
    public function pagar(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'email'       => 'required|email',
            'phone'       => 'required|string',
            'service_id'  => 'required|exists:services,id',
            'payment_id'  => 'required|exists:payments,id',
        ]);

        Userss::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'service_id'  => $request->service_id,
            'payment_id'  => $request->payment_id,
        ]);

        return redirect()->route('index')->with('success', '¡Pago realizado exitosamente!');
    }
}
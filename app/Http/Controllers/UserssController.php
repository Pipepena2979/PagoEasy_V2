<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userss;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Userss::create($request->only('name', 'email', 'phone'));

        return redirect()->back()->with('success', '¡Usuario creado exitosamente!');
    }
}
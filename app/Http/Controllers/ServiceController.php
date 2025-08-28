<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Payment;

class ServiceController extends Controller
{
    // INDEX GENERAL (para el usuario común)
    public function index()
    {
        $services = Service::all();
        $payments = Payment::all();
        return view('index', compact('services', 'payments'));
    }

    // INDEX DEL CRUD (administrar servicios)
    public function servicesIndex()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // Mostrar un servicio (CRUD)
    public function create() {
        return view('services.create');
    }
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('services.show', compact('service'));
    }

    // Formulario de edición
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    // Crear nuevo servicio
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Service::create($request->only('name'));

        return redirect()->route('index')->with('success', '¡Servicio creado exitosamente!');
    }

    // Actualizar un servicio
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->only('name'));

        return redirect()->route('index')->with('success', '¡Servicio actualizado exitosamente!');
    }

    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->route('index')->with('success', '¡Servicio eliminado exitosamente!');
    }
}
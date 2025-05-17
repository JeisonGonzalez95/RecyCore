<?php

namespace App\Http\Controllers;

use App\Models\provider;
use Illuminate\Http\Request;

class providersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function providersList()
    {
        $providers = provider::all();

        return view('providers.providersL', compact('providers'));
    }

    public function createProvider(Request $request)
    {
        $request->validate([
            'name_provider' => 'required',
            'nit_provider' => 'required|unique:providers,nit',
            'phn_provider' => 'required',
            'email_provider' => 'required',
            'address' => 'required'
        ]);

        provider::create([
            'name' => $request->name_provider,
            'nit' => $request->nit_provider,    
            'phone' => $request->phn_provider,
            'email' => $request->email_provider,
            'address' => $request->address
        ]);

        return redirect()->route('providersList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Provedor Creado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function editprovider(Request $request)
    {
        $request->validate([
            'name_provider_e' => 'required|min:2|unique:providers,name,' . $request->id_provider,
            'nit_provider_e' => 'required|min:2|unique:providers,nit,' . $request->id_provider,
            'phn_provider_e' => 'required',
            'email_provider_e' => 'required',
            'address_e' => 'required'
        ]);

        $stateC = 0;
        if ($request->state_provider_e) {
            $stateC = 1;
        }

        $product = provider::findOrFail($request->id_provider);

        $product->update([
            'name' => $request->name_provider_e,
            'nit' => $request->nit_provider_e,
            'phone' => $request->phn_provider_e,
            'email' => $request->email_provider_e,
            'address' => $request->address_e,
            'state' => $stateC,
            'updated_at' => now()
        ]);

        return redirect()->route('providersList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Provedor Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}

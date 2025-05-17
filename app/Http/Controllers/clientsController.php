<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class clientsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function clientsList()
    {
        $clients = Client::all();

        return view('clients.clientsL', compact('clients'));
    }

    public function createClient(Request $request)
    {
        $request->validate([
            'name_client' => 'required|unique:clients,name',
            'nit_client' => 'required|unique:clients,nit',
            'phn_client' => 'required',
            'email_client' => 'required',
            'address' => 'required'
        ]);

        Client::create([
            'name' => $request->name_client,
            'nit' => $request->nit_client,
            'phone' => $request->phn_client,
            'email' => $request->email_client,
            'address' => $request->address
        ]);

        return redirect()->route('clientList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Cliente Creado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function editClient(Request $request)
    {
        $request->validate([
            'name_client_e' => 'required|min:2|unique:clients,name,' . $request->id_client,
            'nit_client_e' => 'required|min:2|unique:clients,nit,' . $request->id_client,
            'phn_client_e' => 'required',
            'email_client_e' => 'required',
            'address_e' => 'required'
        ]);

        $stateC = 0;
        if ($request->state_client_e) {
            $stateC = 1;
        }

        $product = Client::findOrFail($request->id_client);

        $product->update([
            'name' => $request->name_client_e,
            'nit' => $request->nit_client_e,
            'phone' => $request->phn_client_e,
            'email' => $request->email_client_e,
            'address' => $request->address_e,
            'state' => $stateC,
            'updated_at' => now()
        ]);

        return redirect()->route('clientList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Cliente Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}

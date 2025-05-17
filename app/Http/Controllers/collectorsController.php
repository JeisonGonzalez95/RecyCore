<?php

namespace App\Http\Controllers;

use App\Models\Collector;
use App\Models\docTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class collectorsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function collectorsList()
    {
        $collectors = Collector::with(['type'])->get();
        $types = docTypes::all();

        // Obtener solo los códigos únicos
        $countryCodes = $collectors->pluck('country')->unique()->filter()->toArray();

        // Consultar todos los países con un solo request
        $response = Http::withOptions([
            'verify' => false
        ])->get('https://restcountries.com/v3.1/alpha', [
            'codes' => implode(',', $countryCodes),
        ]);

        $countryNames = [];

        if ($response->successful()) {
            $data = $response->json();

            foreach ($data as $country) {
                $code = $country['cca2'];
                $name = $country['name']['common'];
                $countryNames[$code] = $name;
            }
        }

        return view('collectors.collectorsL', compact('collectors', 'types', 'countryNames'));
    }

    public function createCollector(Request $request)
    {
        $request->validate([
            'name_coll' => 'required|unique:collectors,name',
            'type_doc' => 'required',
            'dni_coll' => 'required|unique:collectors,dni',
            'country' => 'required'
        ]);

        Collector::create([
            'name' => $request->name_coll,
            'type_dni' => $request->type_doc,
            'dni' => $request->dni_coll,
            'country' => $request->country,
            'phone' => $request->phn_coll,
            'email' => $request->email_coll,
            'address' => $request->address
        ]);

        return redirect()->route('collectorList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Recolector Creado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function editCollector(Request $request)
    {
        $request->validate([
            'name_coll_e' => 'required|unique:collectors,name,'. $request->id_coll,
            'type_doc_e' => 'required',
            'dni_coll_e' => 'required|unique:collectors,dni,'. $request->id_coll,
            'country_e' => 'required'
        ]);

        $stateC = 0;
        if ($request->state_coll_e) {
            $stateC = 1;
        }

        $collector = Collector::findOrFail($request->id_coll);

        $collector->update([
            'name' => $request->name_coll_e,
            'type_dni' => $request->type_doc_e,
            'dni' => $request->dni_coll_e,
            'country' => $request->country_e,
            'phone' => $request->phn_coll_e,
            'email' => $request->email_coll_e,
            'address' => $request->address_e,
            'state' => $stateC,
            'updated_at' => now()
        ]);

        return redirect()->route('collectorList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Recolector Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}

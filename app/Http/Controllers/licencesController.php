<?php

namespace App\Http\Controllers;

use App\Models\licence;
use Illuminate\Http\Request;

class licencesController extends Controller
{
    public function licencesList()
    {

        $licencesL = licence::all();

        return view('licences.licencesL', compact('licencesL'));
    }

    public function createLicence(Request $request)
    {
        $request->validate([
            'id_employee' => 'required',
            'id_menus*' => 'required',
            'id_items*' => 'required'
        ]);

        licence::create([
            'id_employee' => $request->id_employee,
            'id_menus' => $request->id_menus,
            'id_items' => $request->id_items
        ]);

        return redirect()->route('licencesList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Permiso Creado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function editLicence(Request $request)
    {

        $request->validate([
            'id_menus' => 'required',
            'id_items' => 'required|min:2|unique:main_licences,slug_menu,' . $request->menu_id
        ]);

        $licences = licence::findOrFail($request->employee_id);

        $licences->update([
            'id_menus' => $request->id_menus,
            'id_items' => $request->id_items,
            'updated_at' => now()
        ]);

        return redirect()->route('licencesList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Menú Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function deleteLicence($id)
    {
        
            $licence = licence::findOrFail($id);

            $newState = $licence->state == 1 ? 0 : 1;

            $licence->update([
                'state' => $newState,
                'updated_at' => now()
            ]);

            $accion = $newState == 1 ? 'Activado' : 'Desactivado';
        

        return redirect()->route('licencesList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => "Permiso $accion correctamente.",
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}

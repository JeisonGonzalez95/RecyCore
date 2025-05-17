<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\licence;
use App\Models\mainMenus;
use App\Models\menuItems;
use App\Models\users_app;
use Illuminate\Http\Request;

class licencesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function licencesList()
    {
        $licencesL = licence::all();

        $allMenus = \App\Models\mainMenus::all()->keyBy('id');
        $allItems = \App\Models\menuItems::all()->keyBy('id');

        $licencesL->transform(function ($licence) use ($allMenus, $allItems) {
            $menuIds = explode(',', $licence->id_menus);
            $itemIds = explode(',', $licence->id_items);

            $licence->menus_text = collect($menuIds)->map(function ($id) use ($allMenus) {
                return $allMenus[$id]->name_menu ?? 'Desconocido';
            })->implode(', ');

            $licence->items_text = collect($itemIds)->map(function ($id) use ($allItems) {
                return $allItems[$id]->name_item ?? 'Desconocido';
            })->implode(', ');

            return $licence;
        });

        $users = users_app::whereNotIn('id', function ($query) {
            $query->select('id_user')->from('licences');
        })->where('id', '!=', 1)->get();

        $usersE = users_app::all();
        $menus = mainMenus::all();
        $items = menuItems::all();

        return view('licences.licencesL', compact('licencesL', 'menus', 'items', 'users','usersE'));
    }



    public function createLicence(Request $request)
    {
        $request->validate([
            'employee' => 'required',
            'menus' => 'required|array|min:1',
            'menus.*' => 'integer|exists:main_menus,id',
            'items' => 'required|array|min:1',
            'items.*' => 'integer|exists:menu_items,id',
        ]);

        licence::create([
            'id_user' => $request->employee,
            'id_menus' => implode(',', $request->menus),
            'id_items' => implode(',', $request->items),
        ]);

        return redirect()->route('licenceList')->with('alerta', [
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
            'menus_e' => 'required|array|min:1',
            'menus_e.*' => 'integer|exists:main_menus,id',
            'items_e' => 'required|array|min:1',
            'items_e.*' => 'integer|exists:menu_items,id',
        ]);

        $licence = licence::findOrFail($request->id_licence);

        $licence->update([
            'id_menus' => implode(',', $request->menus_e),
            'id_items' => implode(',', $request->items_e),
            'updated_at' => now()
        ]);

        return redirect()->route('licenceList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Permiso Modificado correctamente.',
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


        return redirect()->route('licenceList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => "Permiso $accion correctamente.",
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}

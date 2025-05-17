<?php

namespace App\Http\Controllers;

use App\Models\mainMenus;
use App\Models\menuItems;
use App\Models\ProductMoviment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class menusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function mainMenus()
    {
        // Traer datos de productos, como ya lo tienes
        $data = ProductMoviment::join('products', 'products.id', '=', 'products_moviments.id_product')
            ->select(
                'products.product_name',
                DB::raw('SUM(products_moviments.amount_kg) as total_kg'),
                DB::raw('SUM(products_moviments.amount_kg * products.price_product_sale) as total_cost')
            )
            ->groupBy('products.product_name')
            ->get();

        // Pasar la variable a la vista
        return view('source.index', compact('data'));
    }



    public function menusItemsList()
    {

        $menusL = mainMenus::all();
        $itemsL = menuItems::all();

        return view('menus.menusL', compact('menusL', 'itemsL'));
    }

    public function createMenu(Request $request)
    {
        $request->validate([
            'name_menu' => 'required',
            'slug_menu' => 'required|unique:main_menus,slug_menu',
            'state_menu' => 'required'
        ]);

        mainMenus::create([
            'name_menu' => $request->name_menu,
            'slug_menu' => $request->slug_menu,
            'state' => $request->state_menu
        ]);

        return redirect()->route('menusList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Menú Creado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function createItem(Request $request)
    {

        $request->validate([
            'name_item' => 'required',
            'route' => 'required',
            'main_menu' => 'required',
            'state' => 'required'
        ]);

        menuItems::create([
            'name_item' => $request->name_item,
            'route_item' => $request->route,
            'main_menu_id' => $request->main_menu,
            'state' => $request->state
        ]);

        return redirect()->route('menusList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Item Creado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function editMenu(Request $request)
    {

        $request->validate([
            'name_menu_e' => 'required',
            'slug_menu_e' => 'required|min:2|unique:main_menus,slug_menu,' . $request->menu_id
        ]);

        $menus = mainMenus::findOrFail($request->menu_id);

        $menus->update([
            'name_menu' => $request->name_menu_e,
            'slug_menu' => $request->slug_menu_e,
            'updated_at' => now()
        ]);

        return redirect()->route('menusList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Menú Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function editItem(Request $request)
    {

        $request->validate([
            'name_item_e' => 'required',
            'route_e' => 'required',
            'main_menu_e' => 'required'
        ]);

        $items = menuItems::findOrFail($request->item_id);

        $items->update([
            'name_item' => $request->name_item_e,
            'route_item' => $request->route_e,
            'main_menu_id' => $request->main_menu_e,
            'updated_at' => now()
        ]);

        return redirect()->route('menusList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Item Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function deleteMai($id, $moi)
    {
        if ($moi == 1) {
            $menu = mainMenus::findOrFail($id);

            $newState = $menu->state == 1 ? 0 : 1;

            $menu->update([
                'state' => $newState,
                'updated_at' => now()
            ]);

            $table = 'Menú';
            $accion = $newState == 1 ? 'Activado' : 'Desactivado';
        } elseif ($moi == 2) {
            $item = menuItems::findOrFail($id);

            $newState = $item->state == 1 ? 0 : 1;

            $item->update([
                'state' => $newState,
                'updated_at' => now()
            ]);

            $table = 'Item';
            $accion = $newState == 1 ? 'Activado' : 'Desactivado';
        }

        return redirect()->route('menusList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => "$table $accion correctamente.",
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}

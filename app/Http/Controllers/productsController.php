<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class productsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function productsList()
    {

        $products = product::all();

        return view('products.productsL', compact('products'));
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'name_prod' => 'required|unique:products,product_name',
            'slug_product' => 'required|unique:products,slug_product',
            'price_product_sale' => 'required',
            'price_product_purch' => 'required'
        ]);

        product::create([
            'product_name' => $request->name_prod,
            'slug_product' => $request->slug_product,
            'price_product_sale' => $request->price_product_sale,
            'price_product_purch' => $request->price_product_purch
        ]);

        return redirect()->route('productList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Producto Creado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }

    public function editProduct(Request $request)
    {
        $request->validate([
            'name_prod_e' => 'required|min:2|unique:main_menus,slug_menu,' . $request->id_product,
            'slug_product_e' => 'required|min:2|unique:main_menus,slug_menu,' . $request->id_product,
            'price_product_sale_e' => 'required',
            'price_product_purch_e' => 'required'
        ]);

        $stateP = 0;
        if ($request->state_product_e) {
            $stateP = 1;
        }

        $product = product::findOrFail($request->id_product);

        $product->update([
            'product_name' => $request->name_prod_e,
            'slug_product' => $request->slug_product_e,
            'price_product_sale' => $request->price_product_sale_e,
            'price_product_purch' => $request->price_product_purch_e,
            'state' => $stateP,
            'updated_at' => now()
        ]);

        return redirect()->route('productList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Producto Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class productsController extends Controller
{
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
            'price_product' => 'required',
            'state_product' => 'required'
        ]);

        product::create([
            'product_name' => $request->name_prod,
            'slug_product' => $request->slug_product,
            'price_product' => $request->price_product,
            'state' => $request->state_product
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
            'name_prod' => 'required|min:2|unique:main_menus,slug_menu,' . $request->id_product,
            'slug_product' => 'required|min:2|unique:main_menus,slug_menu,' . $request->id_product,
            'price_product' => 'required',
            'state_product' => 'required'
        ]);

        $product = product::findOrFail($request->id_product);

        $product->update([
            'product_name' => $request->name_prod,
            'slug_product' => $request->slug_product,
            'price_product' => $request->price_product,
            'state' => $request->state_product,
            'updated_at' => now()
        ]);

        return redirect()->route('menusList')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Producto Modificado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
    

    
}

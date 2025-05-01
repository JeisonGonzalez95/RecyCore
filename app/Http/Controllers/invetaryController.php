<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Collector;
use App\Models\MovimentsIn;
use App\Models\MovimentsOut;
use App\Models\product;
use App\Models\ProductMoviment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class invetaryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inventaryInList()
    {
        $moviments = MovimentsIn::with(['products.product', 'employee'])->where('description', '<>', 'Temporal')->get();

        return view('inventary.inventaryIn', compact('moviments'));
    }


    public function inventaryOutList()
    {

        $products = MovimentsOut::all();

        return view('inventary.inventaryOut', compact('products'));
    }

    public function delMoviment(Request $request)
    {
        MovimentsIn::destroy($request->id);
        return redirect()->route('inventaryI');
    }


    public function inventaryInAdd($tp)
    {

        $employeeId = auth()->id();

        $idIn = MovimentsIn::create([
            'employee_id' => $employeeId,
            'date_in' => now(),
            'description' => 'Temporal'
        ]);

        $clients = Client::where('state', 1)->get();
        $collectors = Collector::where('state', 1)->get();

        $lastId = $idIn->id;
        $products = product::all();

        return view('inventary.inventaryInR', compact('products', 'lastId', 'tp', 'clients', 'collectors'));
    }

    public function regMovimentsIn(Request $request)
    {
        $request->validate([
            'client' => 'required',
            'product.*' => 'required|exists:products,id',
            'amount.*' => 'required',
            'price.*' => 'nullable'
        ]);

        $products = $request->input('product');
        $amounts = $request->input('amount');
        $prices = $request->input('price');

        $movId = $request->movId;
        $movUpd = MovimentsIn::findOrFail($movId);

        $movUpd->update([
            'name_client' => $request->client,
            'description' => $request->description,
            'updated_at' => now()
        ]);

        foreach ($products as $index => $productId) {
            $amount = str_replace(',', '.', $amounts[$index]);
            $price = isset($prices[$index]) ? str_replace(',', '.', $prices[$index]) : null;

            ProductMoviment::create([
                'id_moviment_in' => $movId,
                'id_product' => $productId,
                'amount_kg' => floatval($amount),
                'price_product' => $price !== null ? floatval($price) : null
            ]);
        }

        return redirect()->route('inventaryI')->with('alerta', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'Movimiento N° ' . $movId . ' agregado correctamente.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }


    public function descInventaryIn($id)
    {
        $invin = MovimentsIn::findOrFail($id);
        $invproducts = ProductMoviment::where('id_moviment_in', $invin->id)->get();

        $totalPrice = $invproducts->sum('price_product');

        return view('inventary.inventaryInD', compact('invin', 'invproducts', 'totalPrice'));
    }

    public function dwnlBill($id)
    {
        $moviment = MovimentsIn::with('products.product')->findOrFail($id);

        $client = Client::where('name', $moviment->name_client)->first();
        $isClient = $client ? 1 : 0;

        $pdf = Pdf::loadView('inventary.pdf', [
            'moviment' => $moviment,
            'isClient' => $isClient,
            'client' => $client
        ]);

        return $pdf->download("FCT_00000{$moviment->id}.pdf");
    }
}

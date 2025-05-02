<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Collector;
use App\Models\MovimentsIn;
use App\Models\MovimentsOut;
use App\Models\product;
use App\Models\ProductMoviment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class invetaryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inventaryInList()
    {
        $moviments = MovimentsIn::with(['products.product', 'employee'])
            ->where('description', '<>', 'Temporal')
            ->get();

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
            'type_client' => $tp,
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
        $devs = $request->input('amountDev');
        $prices = $request->input('price');

        $movId = $request->movId;
        $movUpd = MovimentsIn::findOrFail($movId);

        $movUpd->update([
            'id_client' => $request->client,
            'description' => $request->description,
            'updated_at' => now()
        ]);

        foreach ($products as $index => $productId) {
            $amount = str_replace(',', '.', $amounts[$index]);
            $amountDev = isset($devs[$index]) ? str_replace(',', '.', $devs[$index]) : 0;
            $price = isset($prices[$index]) ? str_replace(',', '.', $prices[$index]) : null;

            ProductMoviment::create([
                'id_moviment_in' => $movId,
                'id_product' => $productId,
                'amount_kg' => floatval($amount),
                'amount_dev_kg' => floatval($amountDev),
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

        // Obtener el cliente relacionado
        $clientData = $moviment->client_data;

        // Fecha con Carbon
        $fecha = $moviment->created_at;
        $carbon = Carbon::parse($fecha);
        $data = [
            'dia' => $carbon->format('d'),
            'mes' => $carbon->format('m'),
            'año' => $carbon->format('Y'),
            'numero_remision' => 'ARP-' . str_pad($moviment->id, 2, '0', STR_PAD_LEFT),
            'cliente_nombre' => $clientData?->name ?? 'N/A',
            'cliente_nit' => $clientData && $moviment->type_client == 2 ? $clientData->nit : ($clientData && $moviment->type_client == 1 ? $clientData->dni : 'N/A'),
            'cliente_direccion' => $clientData?->address ?? 'N/A',
            'cliente_telefono' => $clientData?->phone ?? 'N/A',
            'telefono_cc' => '3150062121 - 1018433374',
            'materiales' => $moviment->products->map(function ($product) {
                return [
                    'detalle' => $product->product->product_name,
                    'cantidad' => floatval(str_replace(',', '.', $product->amount_kg)) - floatval(str_replace(',', '.', $product->amount_dev_kg)),
                ];
            }),
            'conductor' => 'DANIEL CAICEDO',
            'tel' => '29920309',
            'cc' => '1233223323',
            'placa' => 'ALA954',
            'diligenciador' => 'LIZETH VERA',
            'observaciones' => '',
            'imagen' => 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logorz.png'))),
        ];

        // Generar el PDF
        $pdf = Pdf::loadView('inventary.pdfRP', $data);

        return $pdf->download("FCT_00000{$moviment->id}.pdf");
    }
}

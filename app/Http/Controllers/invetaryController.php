<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Collector;
use App\Models\MovimentsIn;
use App\Models\MovimentsOut;
use App\Models\product;
use App\Models\ProductMoviment;
use App\Models\provider;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class invetaryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Metodos para entradas

    public function inventaryInList()
    {
        $moviments = MovimentsIn::with(['products.product', 'employee'])
            ->where(function ($query) {
                $query->where('description', '<>', 'Temporal')
                    ->orWhereNull('description');
            })
            ->get();

        return view('inventary.inventaryIn', compact('moviments'));
    }


    public function delMoviment(Request $request)
    {
        $employeeId = auth()->id();

        if ($request->type == 1) {
            // Movimiento de entrada
            MovimentsIn::destroy($request->id);
            session()->forget('mov_in_' . $employeeId);
            $rute = 'inventaryI';
        } else {
            // Movimiento de salida
            MovimentsOut::destroy($request->id);
            session()->forget('mov_out_' . $employeeId);
            $rute = 'inventaryO';
        }

        return redirect()->route($rute);
    }

    public function inventaryInAdd($tp)
    {
        $employeeId = auth()->id();
        $sessionKey = 'mov_in_' . $tp . '_' . $employeeId;

        if (session()->has($sessionKey)) {
            $idIn = MovimentsIn::find(session()->get($sessionKey));
            if (!$idIn) {
                session()->forget($sessionKey);
            }
        }

        if (!isset($idIn)) {
            $idIn = MovimentsIn::create([
                'type_client' => $tp,
                'employee_id' => $employeeId,
                'date_in' => now(),
                'description' => 'Temporal'
            ]);
            session()->put($sessionKey, $idIn->id);
        }

        $clients = Client::where('state', 1)->get();
        $collectors = Collector::where('state', 1)->get();
        $products = product::all();
        $lastId = $idIn->id;

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

        // Limpiar la sesión del movimiento en curso
        $tp = $movUpd->type_client;
        $employeeId = auth()->id();
        session()->forget('mov_in_' . $tp . '_' . $employeeId);

        return redirect()->route('inventaryI')->with([
            'alerta' => [
                'titulo' => '¡Éxito!',
                'mensaje' => 'Movimiento N° ' . $movId . ' agregado correctamente.',
                'icono' => 'success',
                'confirmarTexto' => 'Entendido',
                'mostrarCancelar' => false
            ]
        ]);
    }



    public function descInventaryIn($id)
    {
        $invin = MovimentsIn::findOrFail($id);
        $invproducts = ProductMoviment::where('id_moviment_in', $invin->id)->get();

        $totalPrice = $invproducts->sum('price_product');

        return view('inventary.inventaryInD', compact('invin', 'invproducts', 'totalPrice'));
    }

    // Metodos para Salidas

    public function inventaryOutList()
    {

        $moviments = MovimentsOut::where(function ($query) {
            $query->where('description', '<>', 'Temporal')
                ->orWhereNull('description');
        })->get();


        return view('inventary.inventaryOut', compact('moviments'));
    }

    public function inventaryOutAdd()
    {
        $employeeId = auth()->id();
        $sessionKey = 'mov_out_' . $employeeId;

        if (session()->has($sessionKey)) {
            $idOut = MovimentsOut::find(session()->get($sessionKey));
            if (!$idOut) {
                session()->forget($sessionKey);
            }
        }

        if (!isset($idOut)) {
            $idOut = MovimentsOut::create([
                'employee_id' => $employeeId,
                'date_out' => now(),
                'description' => 'Temporal'
            ]);
            session()->put($sessionKey, $idOut->id);
        }

        $providers = Provider::where('state', 1)->get();
        $products = Product::all();
        $lastId = $idOut->id;

        return view('inventary.inventaryOutR', compact('products', 'lastId', 'providers'));
    }


    public function regMovimentsOut(Request $request)
    {
        $request->validate([
            'provider' => 'required',
            'product.*' => 'required|exists:products,id',
            'amount.*' => 'required',
            'price.*' => 'nullable'
        ]);

        $products = $request->input('product');
        $amounts = $request->input('amount');
        $devs = $request->input('amountDev');
        $prices = $request->input('price');

        $movId = $request->movId;
        $movUpd = MovimentsOut::findOrFail($movId);

        $movUpd->update([
            'id_provider' => $request->provider,
            'description' => $request->description,
            'updated_at' => now()
        ]);

        foreach ($products as $index => $productId) {
            $amount = str_replace(',', '.', $amounts[$index]);
            $amountDev = isset($devs[$index]) ? str_replace(',', '.', $devs[$index]) : 0;
            $price = isset($prices[$index]) ? str_replace(',', '.', $prices[$index]) : null;

            ProductMoviment::create([
                'id_moviment_out' => $movId,
                'id_product' => $productId,
                'amount_kg' => floatval($amount),
                'amount_dev_kg' => floatval($amountDev),
                'price_product' => $price !== null ? floatval($price) : null
            ]);
        }

        // Limpiar la sesión para evitar registros duplicados
        $employeeId = auth()->id();
        session()->forget('mov_out_' . $employeeId);

        return redirect()->route('inventaryO')->with([
            'alerta' => [
                'titulo' => '¡Éxito!',
                'mensaje' => 'Movimiento N° ' . $movId . ' agregado correctamente.',
                'icono' => 'success',
                'confirmarTexto' => 'Entendido',
                'mostrarCancelar' => false
            ]
        ]);
    }


    public function descInventaryOut($id)
    {
        $invout = MovimentsOut::findOrFail($id);
        $invproducts = ProductMoviment::where('id_moviment_out', $invout->id)->get();

        $totalPrice = $invproducts->sum('price_product');

        return view('inventary.inventaryOutD', compact('invout', 'invproducts', 'totalPrice'));
    }

    public function dwnlBill($id)
    {
        $moviment = MovimentsOut::with('products.product')->findOrFail($id);

        $providerData = $moviment->provider;

        $fecha = $moviment->date_out;
        $carbon = Carbon::parse($fecha);
        $data = [
            'dia' => $carbon->format('d'),
            'mes' => $carbon->format('m'),
            'año' => $carbon->format('Y'),
            'numero_remision' => 'RCP-' . str_pad($moviment->id, 2, '0', STR_PAD_LEFT),
            'cliente_nombre' => $providerData?->name ?? 'N/A',
            'cliente_nit' => $providerData?->nit ?? 'N/A',
            'cliente_direccion' => $providerData?->address ?? 'N/A',
            'cliente_telefono' => $providerData?->phone ?? 'N/A',
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
            'diligenciador' => 'RECYPLUS',
            'observaciones' => '',
            'imagen' => 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/recyplus1.png'))),
        ];

        $pdf = Pdf::loadView('inventary.pdfRP', $data);

        return $pdf->download("RCP_00000{$moviment->id}.pdf");
    }

    public function dwnlCert($id)
    {
        $moviment = MovimentsIn::with('products.product')->findOrFail($id);
        $clientData = $moviment->client_data;

        $materiales = [];
        foreach ($moviment->products as $index => $product) {
            $materiales[] = [
                'item'     => $index + 1,
                'producto' => $product->product->product_name ?? 'N/D',
                'cantidad' => $product->amount_kg,
            ];
        }

        $data = [
            'no_cert'    => $moviment->id,
            'entidad'    => $clientData->name,
            'nit'        => $clientData->nit,
            'fecha'      => $moviment->date_in->format('d-m-Y'),
            'materiales' => $materiales,
            'fecha_certificado' => Carbon::now()->format('d-m-Y'),
        ];

        $pdf = PDF::loadView('inventary.certificade', $data);

        return $pdf->download("CERTIFICADO DE RECOLECCION {$clientData->name}.pdf");
    }
}

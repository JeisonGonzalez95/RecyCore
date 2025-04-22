<?php

namespace App\Http\Controllers;

use App\Models\InventaryIn;
use App\Models\InventaryOut;
use App\Models\product;
use Illuminate\Http\Request;

class invetaryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inventaryInList()
    {


        $products = InventaryIn::all();

        return view('inventary.inventaryIn', compact('products'));
    }
    public function inventaryOutList()
    {

        $products = InventaryOut::all();

        return view('inventary.inventaryOut', compact('products'));
    }

    public function inventaryInAdd()
    {
        $products = product::all();
        $in = InventaryIn::latest()->value('id');

        $lastId = $in + 1;

        return view('inventary.inventaryInR', compact('products','lastId'));
    }

}

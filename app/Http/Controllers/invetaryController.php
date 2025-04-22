<?php

namespace App\Http\Controllers;

use App\Models\inventaryIn;
use App\Models\inventaryOut;
use Illuminate\Http\Request;

class invetaryController extends Controller
{
    public function inventaryInList()
    {

        // $products = inventaryIn::all();

        return view('inventary.inventaryIn');
    }
    public function inventaryOutList()
    {

        // $products = inventaryOut::all();

        return view('inventary.inventaryOut');
    }

}

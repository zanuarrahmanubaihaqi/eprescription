<?php

namespace App\Http\Controllers;

use App\User;
use App\Log;
use App\Obat;
use App\Signa;
use Illuminate\Http\Request;

class ObatController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $obat = Obat::all();
    	return view('obat.index', compact('obat'));
    }

    public function tambah(Request $request)
    {
    	dd($request);
    }
}
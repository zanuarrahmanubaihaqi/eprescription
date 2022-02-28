<?php

namespace App\Http\Controllers;

use App\User;
use App\Log;
use App\Obat;
use App\Signa;
use Illuminate\Http\Request;

class SignaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $signa = Signa::all();
    	return view('signa.index', compact('signa'));
    }

    public function tambah(Request $request)
    {
    	dd($request);
    }
}
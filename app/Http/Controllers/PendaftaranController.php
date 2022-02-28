<?php

namespace App\Http\Controllers;

use App\User;
use App\Log;
use App\Kunjungan;
use App\KunjunganStatus;
use App\Level;
use App\Poli;
use App\PoliStatus;
use App\Pasien;
use App\PembayaranStatus;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('pendaftaran.pendaftaran');
    }

    public function tambah(Request $request)
    {
    	dd($request);
    }
}
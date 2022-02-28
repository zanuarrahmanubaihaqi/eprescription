<?php

namespace App\Http\Controllers;

use App\User;
use App\Log;
use App\Obat;
use App\Signa;
use App\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $resep = Resep::getData();
        $obat = Obat::all();
        $signa = Signa::all();
        $status = "";
    	return view('resep.index', compact('resep', 'obat', 'signa', 'status'));
    }

    public function tambah(Request $request)
    {
        $initial_id = "R" . date('Ymd');
        $temp_id = (substr(Resep::getLastTransactionId(), -3) * 1) + 1;
        $transaction_id = $initial_id . sprintf("%03s", $temp_id);
        $data = [[]];
        foreach ($request as $key => $value) {
            if ($key == "request") {
                foreach ($value as $keyv => $valuev) {
                    if (preg_match("/obatalkes_id/", $keyv)) {
                        $data[substr($keyv, Resep::getLength(1, strlen($keyv)))]['obatalkes_id'] = $valuev;
                    }
                    if (preg_match("/obatalkes_nama/", $keyv)) {
                        $data[substr($keyv, Resep::getLength(2, strlen($keyv)))]['obatalkes_nama'] = $valuev;
                    }
                    if (preg_match("/signa_id/", $keyv)) {
                        $data[substr($keyv, Resep::getLength(3, strlen($keyv)))]['signa_id'] = $valuev;
                    }
                    if (preg_match("/signa_nama/", $keyv)) {
                        $data[substr($keyv, Resep::getLength(4, strlen($keyv)))]['signa_nama'] = $valuev;
                    }
                    if (preg_match("/qty/", $keyv)) {
                        $data[substr($keyv, Resep::getLength(5, strlen($keyv)))]['qty'] = $valuev;
                    }
                }
            }
        }
        unset($data[0]);
        $data = array_values($data);
        $for_insert = [
            'transaction_id' => $transaction_id,
            'tgl_resep' => $request->tgl_resep,
            'pasien_nama' => $request->pasien_nama,
            'apoteker_nama' => $request->apoteker_nama,
            'dokter_nama' => $request->dokter_nama,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        foreach ($data as $key => $value) {
            $for_insert['obatalkes_id'] = $value['obatalkes_id'];
            $for_insert['signa_id'] = $value['signa_id'];
            $for_insert['obatalkes_nama'] = $value['obatalkes_nama'];
            $for_insert['signa_nama'] = $value['signa_nama'];
            $for_insert['obatalkes_kode'] = Obat::getObatalkesKode($value['obatalkes_id']);
            $for_insert['signa_kode'] = Signa::getSignaKode($value['signa_id']);
            $for_insert['qty'] = $value['qty'];

            /* chcek and or update stock */
            $status = "[FAILED]";
            if (Obat::checkForUdateStock($value['obatalkes_id'], $value['qty'])) {
                if (Resep::saveResep($for_insert)) {
                    $status = "[SUCCESS]";
                }
            }
            /* eof chcek and or update stock */

            Log::insert([
                'ket' => $status . ' add data for resep : ' . $transaction_id,
                'user_id' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('resep.index')->with('message', $status . ' add data for resep : ' . $transaction_id);
    }
}
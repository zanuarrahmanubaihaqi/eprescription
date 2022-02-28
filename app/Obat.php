<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obatalkes_m';
    protected $primaryKey = 'obatalkes_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];
    

    public static function getObatalkesKode($id) {
        $data = Obat::select('obatalkes_kode')
                ->where('obatalkes_id', '=', $id)->first();
        return $data->obatalkes_kode;
    }


    public static function checkForUdateStock($id, $qty) {
        $data_qty = Obat::select('stok')
                    ->where('obatalkes_id', '=', $id)->first();
        if ($data_qty->stok >= $qty) {
            Obat::where('obatalkes_id', '=', $id)
                ->update([
                    'stok' => (int) $data_qty->stok - (int) $qty
                ]);
            return true;
        } else {
            return false;
        }
    }
}

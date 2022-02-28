<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signa extends Model
{
    protected $table = 'signa_m';
    protected $primaryKey = 'signa_id';
    public $guarded = [];

    public static function getSignaKode($id) {
        $data = Signa::select('signa_kode')
                ->where('signa_id', '=', $id)->first();
        return $data->signa_kode;
    }
}

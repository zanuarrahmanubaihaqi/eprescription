<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Resep extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'resep_id';
    public $guarded = [];

    public static function getData() {
        $data = DB::table('resep')
                ->select('transaction_id', 'pasien_nama', 'dokter_nama')
                ->orderByDesc('transaction_id')
                ->groupBy('transaction_id', 'pasien_nama', 'dokter_nama')->get();
        return $data;
    }

    public static function getLastTransactionId() {
        $data = DB::table('resep')
                ->select('transaction_id')
                ->groupBy('transaction_id')
                ->orderByDesc('transaction_id')
                ->first();
        return $data->transaction_id;   
    }

    public static function getLength($kode, $str_len) {
        switch ($kode) {
            case 1: // obatalkes_id
                if ($str_len == 13) {
                    return -1;
                } else {
                    return -2;
                }
                break;

            case 2: // obatalkes_nama
                if ($str_len == 15) {
                    return -1;
                } else {
                    return -2;
                }
                break;

            case 3: // signa_id
                if ($str_len == 9) {
                    return -1;
                } else {
                    return -2;
                }
                break;

            case 4: // signa_nama
                if ($str_len == 11) {
                    return -1;
                } else {
                    return -2;
                }
                break;

            case 5: // qty
                if ($str_len == 4) {
                    return -1;
                } else {
                    return -2;
                }
                break;
            
            default:
                return -1;
                break;
        }
    }

    public static function saveResep($data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            if (Resep::create($data)) {
                $result = true;
            }
            DB::commit();
            return $result;
        } catch (QueryException $e) {
            DB::rollback();
            $get_last_id = Resep::select('resep_id')
                            ->orderByDesc('resep_id')
                            ->first();
            if ($get_last_id != null) {
                $id = $get_last_id->resep_id;
            } else {
                $id = 0;
            }
            $data['resep_id'] = $id + 1;
            self::saveResep($data);
            $result = false;
        }
    }
}

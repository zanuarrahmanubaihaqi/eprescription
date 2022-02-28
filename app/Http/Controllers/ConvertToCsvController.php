<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use DB;

class ConvertToCsvController extends Controller
{
	public function getDataToTxt($table_name) {
		$data = DB::table($table_name)->get();
		$data_encode = json_encode($data); // jika butuh data json
		$data_decode = json_decode($data_encode); // untuk mengembalikan data json ke semula
		$temp_data1 = [];
		$temp_data2 = [];
		$data_imploded = "";
		foreach($data as $key => $value) {
			foreach ($value as $key0 => $value0) {
				// var_dump(is_numeric($value0));
				$temp_data1[$key0] = ($value0 == NULL || "" ? 'NULL' : !is_numeric($value0)) ? "'" . $value0 . "'" : $value0;
				$temp_data2[$key] = "(". implode(',', $temp_data1) .")";
			}
		}
		// die();
		// dd($temp_data2);
		$data_imploded = implode(",", $temp_data2); // untuk "insert value"
		Storage::disk('local')->put($table_name . '_forInsertValues.txt', $data_imploded);
		echo "see file " . $table_name . "_forInsertValues.txt in storege/app";
	}

	public function convertToCsv($table_name) {
		$path = "'C:\Users\halalpedia\Downloads\PI_maintenance_countermesin.csv'";
		DB::select('copy (SELECT * FROM "PI_maintenance_countermesin") TO ' . $path . ' WITH csv');
	}

	public function getFileContentAndMakeTable($table_name) {
		$file = $table_name . ".txt";
		// dd(DB::table($table_name)->get());
		$getFile = Storage::disk('local')->get($file);
		$arrData = json_decode(Storage::disk('local')->get($file));
		$temp_data = [];
		$key_data = [];
		$value_data = [];
		foreach ($arrData as $key => $value) {
			foreach($value as $key0 => $value0) {
				$temp_data[$key0] = $value0;
				$key_data[] = $key0;
				$value_data[] = $value0;
			}
			DB::table($table_name)->insert($temp_data);
		}
		echo "check the database and see " . $table_name . " table !";
	}
}
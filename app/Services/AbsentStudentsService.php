<?php
namespace App\Services;

use DB;
use App\Repositories\AbsentStudentsRepository;

class AbsentStudentsService
{
    // TODO : Make you own service method
	public static function stats(){
		$date = allDates();
		$data['dates'] = '';
		$data['tepat_waktu'] = '';
		$data['terlambat'] = '';
		$data['sakit'] = '';
		$data['izin'] = '';
		$data['alpa'] = '';
		$data['bolos'] = '';

		foreach ($date as $key => $row) {
			if (!isholiday($row)) {
				$data['dates'] .= '"'.$row->format('D').' '.$row->format('d').'",';
				$data['tepat_waktu'] .= AbsentStudentsRepository::stats('Tepat Waktu',$row->format('Y-m-d')).',';
				$data['terlambat'] .= AbsentStudentsRepository::stats('Terlambat',$row->format('Y-m-d')).',';
				$data['sakit'] .= AbsentStudentsRepository::stats('Sakit',$row->format('Y-m-d')).',';
				$data['izin'] .= AbsentStudentsRepository::stats('Izin',$row->format('Y-m-d')).',';
				$data['alpa'] .= AbsentStudentsRepository::stats('Tanpa Keterangan',$row->format('Y-m-d')).',';
				$data['bolos'] .= AbsentStudentsRepository::stats('Bolos',$row->format('Y-m-d')).',';
			}
		}

		return $data;

	}
}
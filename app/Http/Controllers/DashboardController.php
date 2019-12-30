<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsentStudents;
use App\Repositories\AbsentStudentsRepository;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\Rombels;
use App\Models\Rayons;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'Dashboard';
		$data['students'] = Students::all()->count();
		$data['teachers'] = Teachers::all()->count();
		$data['rombels'] = Rombels::all()->count();
		$data['rayons'] = Rayons::all()->count();
		$date = allDates();

		$dates = '';
		$tepat_waktu = '';
		$terlambat = '';
		$sakit = '';
		$izin = '';
		$alpa = '';
		$bolos = '';

		foreach ($date as $key => $row) {
			$dates .= '"'.$row->format('d').'",';
			$tepat_waktu .= AbsentStudentsRepository::stats('Tepat Waktu',$row->format('Y-m-d')).',';
			$terlambat .= AbsentStudentsRepository::stats('Terlambat',$row->format('Y-m-d')).',';
			$sakit .= AbsentStudentsRepository::stats('Sakit',$row->format('Y-m-d')).',';
			$izin .= AbsentStudentsRepository::stats('Izin',$row->format('Y-m-d')).',';
			$alpa .= AbsentStudentsRepository::stats('Tanpa Keterangan',$row->format('Y-m-d')).',';
			$bolos .= AbsentStudentsRepository::stats('Bolos',$row->format('Y-m-d')).',';
		}

		$data['dates'] = $dates;
		$data['tepat_waktu'] = $tepat_waktu;
		$data['terlambat'] = $terlambat;
		$data['sakit'] = $sakit;
		$data['izin'] = $izin;
		$data['alpa'] = $alpa;
		$data['bolos'] = $bolos;

		return view('dashboard',$data);
	}
}

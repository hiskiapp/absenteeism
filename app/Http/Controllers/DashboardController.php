<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsentStudents;
use App\Repositories\AbsentStudentsRepository;
use App\Services\AbsentStudentsService;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\Rombels;
use App\Models\Rayons;

class DashboardController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'Dashboard';
		$data['students'] = Students::all()->count();
		$data['teachers'] = Teachers::all()->count();
		$data['rombels'] = Rombels::all()->count();
		$data['rayons'] = Rayons::all()->count();

		$stats = AbsentStudentsService::stats();
		$data['dates'] = $stats['dates'];
		$data['tepat_waktu'] = $stats['tepat_waktu'];
		$data['terlambat'] = $stats['terlambat'];
		$data['sakit'] = $stats['sakit'];
		$data['izin'] = $stats['izin'];
		$data['alpa'] = $stats['alpa'];
		$data['bolos'] = $stats['bolos'];

		return view('dashboard',$data);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogBackend;

class LogsController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'Log Activity';
		$data['page_description'] = 'Riwayat Aktivitas Admin';
		if (g('date-range')) {
    		$date = explode(' - ', g('date-range'));
    		$start = dateDb($date[0]);
    		$end = dateDb($date[1]);

			$data['data'] = LogBackend::simpleQuery()
			->whereBetween('created_at',[$start,$end])
			->orderBy('created_at','desc')
			->get();
		}else{
			$data['data'] = LogBackend::simpleQuery()
			->orderBy('created_at','desc')
			->get();
		}

		return view('log.index',$data);
	}
}

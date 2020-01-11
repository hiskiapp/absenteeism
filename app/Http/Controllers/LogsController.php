<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogBackend;
use App\Repositories\LogBackendRepository;

class LogsController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'Log Activity';
		$data['page_description'] = 'Riwayat Aktivitas Admin';
		if (g('date-range')) {
    		$date = explode(' - ', g('date-range'));
    		$start = dateDb($date[0]);
    		$end = dateDb($date[1]);

			$data['data'] = LogBackendRepository::list($start,$end);
		}else{
			$data['data'] = LogBackendRepository::list();
		}

		return view('log.index',$data);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogBackend;
use App\Repositories\LogBackendRepository;
use DataTables;

class LogsController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'Log Activity';
		$data['page_description'] = 'Riwayat Aktivitas Admin';

		return view('log.index',$data);
	}
}

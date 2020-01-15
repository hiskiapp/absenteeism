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

	public function getJson(){
		$data = LogBackendRepository::list(g('date'));

		return DataTables::of($data)
		->editColumn("action", function ($data) {
			if ($data->action == 'Create') {
				$btn = 'success';
			}elseif ($data->action == 'Update') {
				$btn = 'info';
			}elseif ($data->action == 'Read') {
				$btn = 'primary';
			}else{
				$btn = 'danger';
			}
			return '<span class="btn btn-'.$btn.' btn-xs">'.$data->action.'</span>';
		})
		->addColumn("datetime", function ($data) {
			return dt($data->created_at)->format('d-m-Y H:i');
		})
		->addColumn('info', function ($data) {
			return timeHumanReadable($data->created_at);
		})
		->make(true);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Models\Settings;
use App\Repositories\LogBackendRepository;

class SettingsController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'Pengaturan';
		$data['data'] = Settings::all();

		return view('settings.index',$data);
	}

	public function postIndex(){
		$data = Settings::all();

		foreach ($data as $key => $row) {
			$edit = Settings::findBySlug($row->slug);
			$edit->setContent(g($row->slug));
			$edit->save();
		}

		$log['action'] = 'Update';
		$log['page'] = 'Pengaturan';
		$log['description'] = 'Mengubah Content Pengaturan';
		LogBackendRepository::add($log);

		return redirect('students')->with(['message_type' => 'success', 'message' => 'Data Berhasil Diupdate!']);
	}
}

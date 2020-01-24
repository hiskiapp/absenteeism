<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Repositories\NotificationsRepository;
use App\Repositories\LogBackendRepository;

class NotificationsController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'List Notifikasi';
		$data['page_description'] = 'Siabsensi '.app_name();
		$data['data'] = Notifications::all();

		return view('notifications.index',$data);
	}

	public function getGo($id){
		NotificationsRepository::setRead($id);

		NotificationsRepository::url($id);
		return redirect(NotificationsRepository::url($id));
	}

	public function postMarkAll(){
		if (NotificationsRepository::markAll()) {
			$log['action'] = 'Update';
			$log['page'] = 'List Notifikasi';
			$log['description'] = 'Menandai Semua Notifikasi Menjadi Telah Dibaca';
			LogBackendRepository::add($log);

			$result['ajax_status'] = 1;
			$result['ajax_message'] = 'Berhasil Menandai Semua Notifikasi Menjadi Telah Dibaca';
		}else{
			$result['ajax_status'] = 0;
			$result['ajax_message'] = 'Tidak Ada Yang Ditandai!';
		}

		return response()->json($result);
	}
}

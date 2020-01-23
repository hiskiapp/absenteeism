<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Repositories\NotificationsRepository;
use App\Repositories\LogBackendRepository;

class NotificationsController extends Controller
{
	public function getIndex(){
		if (NotificationsRepository::count() != 0) {
			$data['page_title'] = '('.NotificationsRepository::count().') List Notifikasi';
		}else{
			$data['page_title'] = 'List Notifikasi';
		}

		$data['data'] = Notifications::all();

		return view('notifications.index',$data);
	}

	public function getGo($id){
		NotificationsRepository::setRead($id);

		return redirect(NotificationsRepository::url($id));
	}

	public function postMarkAll(){
		NotificationsRepository::markAll();

		$log['action'] = 'Update';
		$log['page'] = 'List Notifikasi';
		$log['description'] = 'Menandai Semua Notifikasi Menjadi Telah Dibaca';
		LogBackendRepository::add($log);

		return redirect()->back()->with([
			'message_type' => 'success',
			'message'	   => 'Berhasil Menandai Semua Notifikasi Menjadi Telah Dibaca!'
		]);
	}
}

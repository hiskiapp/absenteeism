<?php
namespace App\Repositories;

use DB;
use App\Models\Notifications;

class NotificationsRepository extends Notifications
{
    // TODO : Make you own query methods
    public static function init(){
    	$init = New Notifications;
    	$init->setIcon('pallet');
    	$init->setColor('success');
    	$init->setTitle('Berhasil Menginstall Project!');
    	$init->setDescription('Selamat Datang di Aplikasi Siabsensi!');
    	$init->setUrl(url('/'));
    	$init->setIsRead(0);
    	$init->save();
    }

	public static function add($data){
		$new = New Notifications;
		$new->setIcon($data['icon']);
		$new->setColor($data['color']);
		$new->setTitle($data['title']);
		$new->setDescription($data['description']);
		$new->setUrl($data['url']);
		$new->setIsRead(0);
		$new->save();
	}

	public static function setRead($id){
		$data = Notifications::findById($id);
		$data->setIsRead(1);
		$data->save();
	}

	public static function url($id){
		$data = Notifications::findById($id);

		return $data->getUrl();
	}

	public static function markAll(){
		$query = Notifications::simpleQuery()
		->where('is_read',0)
		->update(['is_read' => '1']);
	}

	public static function count($is_today = null){
		if ($is_today) {
			$query = Notifications::simpleQuery()
			->whereDate('created_at',now())
			->get();
		}else{
			$query = Notifications::findAllByIsRead(0);
		}

		return $query->count();
	}

	public static function head(){
		$query = Notifications::simpleQuery()
		->orderBy('created_at','desc')
		->limit(4)
		->get();

		return $query;
	}

	public static function list(){
		$query = Notifications::simpleQuery()
		->orderBy('created_at','desc')
		->get();

		return $query;
	}
}
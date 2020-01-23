<?php
namespace App\Repositories;

use DB;
use App\Models\Notifications;

class NotificationsRepository extends Notifications
{
    // TODO : Make you own query methods
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
		$query = Notifications::findAllByIsRead(0);
		$query->setIsRead(1);
		$query->save();
	}

	public static function count(){
		$query = Notification::findAllByIsRead(0);

		return $query->count();
	}
}
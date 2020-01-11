<?php
namespace App\Repositories;

use DB;
use App\Models\LogBackend;

class LogBackendRepository extends LogBackend
{
    // TODO : Make you own query methods
	public static function add($data){
		$new = New LogBackend;
		$new->setAction($data['action']);
		$new->setPage($data['page']);
		$new->setDescription($data['description']);
		$new->save();
	}

	public static function timeline(){
		$data = LogBackend::simpleQuery()
		->orderBy('created_at','desc')
		->limit(10)
		->get();

		return $data;
	}

	public static function list($start = null, $end = null){
		if ($start == null && $end == null) {
			$query = LogBackend::simpleQuery()
			->orderBy('created_at','desc')
			->get();
		}else{
			$query = LogBackend::simpleQuery()
			->whereBetween('created_at',[$start,$end])
			->orderBy('created_at','desc')
			->get();
		}

		return $query;
	}
}
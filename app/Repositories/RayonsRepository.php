<?php
namespace App\Repositories;

use DB;
use App\Models\Rayons;
use App\Models\Students;

class RayonsRepository extends Rayons
{
    // TODO : Make you own query methods
	public static function data($id){
		$query = Rayons::simpleQuery()
		->where('id', $id)
		->first();

		return $query;
	}

	public static function count($id){
		$query = Students::simpleQuery()
		->where('rayons_id',$id)
		->get()
		->count();

		return $query;
	}
}
<?php
namespace App\Repositories;

use DB;
use App\Models\Rayons;

class RayonsRepository extends Rayons
{
    // TODO : Make you own query methods
	public static function data($id){
		$query = Rayons::simpleQuery()
		->where('id', $id)
		->first();

		return $query;
	}
}
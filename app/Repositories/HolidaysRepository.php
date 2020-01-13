<?php
namespace App\Repositories;

use DB;
use App\Models\Holidays;

class HolidaysRepository extends Holidays
{
    // TODO : Make you own query methods
	public static function list(){
		$query = Holidays::simpleQuery()->orderBy('date','asc')->get();

		return $query;
	}

	public static function data($id){
		$query = Holidays::simpleQuery()
		->where('id',$id)
		->first();

		return $query;
	}
}
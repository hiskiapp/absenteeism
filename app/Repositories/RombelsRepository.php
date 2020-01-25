<?php
namespace App\Repositories;

use DB;
use App\Models\Rombels;
use App\Models\Students;

class RombelsRepository extends Rombels
{
    // TODO : Make you own query methods
	public static function count($id){
		$query = Students::simpleQuery()
		->where('rombels_id',$id)
		->get()
		->count();

		return $query;
	}
}
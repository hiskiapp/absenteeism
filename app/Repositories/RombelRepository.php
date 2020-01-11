<?php
namespace App\Repositories;

use DB;
use App\Models\Rombels;

class RombelRepository extends Rombel
{
    // TODO : Make you own query methods
	public static function data($id){
		$query = Rombels::simpleQuery()
		->where('id', $id)
		->first();

		return $query;
	}
}
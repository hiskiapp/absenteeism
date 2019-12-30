<?php
namespace App\Repositories;

use DB;
use App\Models\AbsentStudents;

class AbsentStudentsRepository extends AbsentStudents
{
    // TODO : Make you own query methods
	public static function stats($value,$date){
		$query = AbsentStudents::simpleQuery()
		->where('type',$value)
		->whereDate('date',$date)
		->get()->count();

		return $query;
	}
}
<?php
namespace App\Repositories;

use DB;
use App\Models\AbsentTeachers;

class AbsentTeachersRepository extends AbsentTeachers
{
    // TODO : Make you own query methods
	public static function data($id,$date){
		$query = AbsentTeachers::simpleQuery()
		->where('teachers_id',$id)
		->whereDate('date',$date->format('Y-m-d'))
		->first();

		return $query;
	}

	public static function listFilter($type){
		$query = AbsentTeachers::simpleQuery()->get()
		->groupBy(function($d){
			return dt($d->created_at)->format($type);
		});

		return $query;
	}

	public static function check($id,$date){
		$query = AbsentTeachers::simpleQuery()
		->where('teachers_id',$id)
		->whereDate('date',dateDb($date))
		->first();

		return $query;
	}

	public static function update($id,$date){
		$query = AbsentTeachers::simpleQuery()
		->where('teachers_id',$id)
		->whereDate('date',dateDb($date));

		return $query;
	}
}
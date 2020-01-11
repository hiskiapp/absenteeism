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

	public static function list($date){
		$query = AbsentStudents::simpleQuery()
		->join('students','students.id','=','absent_students.students_id')
		->join('rombels','students.rombels_id','=','rombels.id')
		->whereDate('absent_students.date',$date->format('Y-m-d'))
		->select('students.nis as nis','students.name as name','rombels.name as rombel','absent_students.time_in as time_in','absent_students.type as type','absent_students.photo as photo')
		->get();

		return $query;
	}

	public static function check($id,$date){
		$query = AbsentStudents::simpleQuery()
		->where('students_id',$id)
		->whereDate('date',dateDb($date))
		->first();

		return $query;
	}

	public static function listFilter($type){
		$query = AbsentStudents::simpleQuery()->get()
		->groupBy(function($d){
			return dt($d->created_at)->format($type);
		});

		return $query;
	}

	public static function update($id,$date){
		$query = AbsentStudents::simpleQuery()
		->where('students_id',$data->getId())
		->whereDate('date',dateDb(g('add-date')));

		return $query;
	}
}
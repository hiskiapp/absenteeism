<?php
namespace App\Repositories;

use DB;
use App\Models\Students;
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

	public static function update($id,$date){
		$query = AbsentStudents::simpleQuery()
		->where('students_id',$id)
		->whereDate('date',dateDb($date));

		return $query;
	}

	public static function set($type){
		if ($type == 'Tanpa Keterangan') {
			$not_in = AbsentStudents::simpleQuery()
			->whereDate('date',date('Y-m-d'))
			->get();

			$arr = [];
			foreach ($not_in as $key => $row) {
				$arr[] = array($row->students_id);
			}

			$for = Students::simpleQuery()
			->whereNotIn('id',$arr)
			->get();

			$count = 0;
			foreach ($for as $key => $row) {
				$count += 1;
				$new = New AbsentStudents;
				$new->setDate(date('Y-m-d'));
				$new->setTimeIn(NULL);
				$new->setStudentsId($row->id);
				$new->setType($type);
				$new->setIsOut(NULL);
				$new->save();
			}
		}else{
			$in = AbsentStudents::simpleQuery()
			->whereDate('date',date('Y-m-d'))
			->where('is_out',0)
			->get();

			$arr = [];
			foreach ($in as $key => $row) {
				$arr[] = array($row->students_id);
			}

			$for = Students::simpleQuery()
			->WhereIn('id',$arr)
			->get();

			$count = 0;
			foreach ($for as $key => $row) {
				$count += 1;
				$update = AbsentStudents::findBy('students_id',$row->id);
				$update->setType($type);
				$update->setIsOut(NULL);
				$update->save();
			}
		}

		return $count;
	}
}
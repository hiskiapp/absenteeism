<?php
namespace App\Repositories;

use DB;
use App\Models\Teachers;
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

	public static function set($type){
		if ($type == 'Tanpa Keterangan') {
			$not_in = AbsentTeachers::simpleQuery()
			->whereDate('date',date('Y-m-d'))
			->get();

			$arr = [];
			foreach ($not_in as $key => $row) {
				$arr[] = array($row->teachers_id);
			}

			$for = Teachers::simpleQuery()
			->whereNotIn('id',$arr)
			->where('weekdays','like','%'.date('l').'%')
			->get();

			$count = 0;
			foreach ($for as $key => $row) {
				$count += 1;
				$new = New AbsentTeachers;
				$new->setDate(date('Y-m-d'));
				$new->setTimeIn(NULL);
				$new->setTeachersId($row->id);
				$new->setType($type);
				$new->setIsOut(NULL);
				$new->save();
			}
		}else{
			$in = AbsentTeachers::simpleQuery()
			->whereDate('date',date('Y-m-d'))
			->where('is_out',0)
			->get();

			$arr = [];
			foreach ($in as $key => $row) {
				$arr[] = array($row->students_id);
			}

			$for = Teachers::simpleQuery()
			->WhereIn('id',$arr)
			->get();

			$count = 0;
			foreach ($for as $key => $row) {
				$count += 1;
				$update = AbsentTeachers::findBy('students_id',$row->id);
				$update->setType($type);
				$update->setIsOut(NULL);
				$update->save();
			}
		}

		return $count;
	}

	public static function statIndv($id,$type,$date){
		$date = dt($date);

		$data = AbsentTeachers::simpleQuery()
		->where('teachers_id',$id)
		->where('type',$type)
		->whereBetween('created_at',[
			$date->startOfMonth()->format('Y-m-d'),
			$date->endOfMonth()->format('Y-m-d')
		])->get();

		return $data->count();
	}
}
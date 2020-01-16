<?php
namespace App\Repositories;

use DB;
use App\Models\Students;
use App\Models\Rombels;

class StudentsRepository extends Students
{
    // TODO : Make you own query methods
	public static function birthCity(){
		$query = Students::simpleQuery()
		->select('birth_city')
		->groupBy('birth_city')
		->get();

		$arr = [];
		foreach ($query as $key => $row) {
			$arr[] = $row->birth_city;
		}

		$data = implode('","', $arr);

		return $data;
	}

	public static function json(){
		$query = Students::simpleQuery()
		->join('rombels','students.rombels_id','=','rombels.id')
		->join('rayons','students.rayons_id','=','rayons.id')
		->select('students.id','students.nis as nis','students.name as name','rombels.name as rombel','rayons.name as rayon','students.gender','students.birth_city','students.religion')
		->get();

		return $query;
	}

	public static function listByRombel($id = NULL){
		if ($id == NULL) {
			$lastid = Rombels::simpleQuery()->first()->id;
			$query = Students::simpleQuery()
			->where('rombels_id',$lastid)
			->orderBy('name','asc')
			->get();
		}else{
			$query = Students::simpleQuery()
			->where('rombels_id',g('rombels_id'))
			->orderBy('name','asc')
			->get();
		}

		return $query;
	}
}
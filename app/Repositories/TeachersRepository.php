<?php
namespace App\Repositories;

use DB;
use App\Models\Teachers;

class TeachersRepository extends Teachers
{
    // TODO : Make you own query methods
	public static function subjects(){
		$query = Teachers::simpleQuery()
		->select('subjects')
		->groupBy('subjects')
		->get();

		$arr = [];
		foreach ($query as $key => $row) {
			$arr[] = $row->subjects;
		}

		$data = implode('","', $arr);

		return $data;
	}

	public static function weekdays($id){
		$data = Teachers::findById($id);
		$result = explode(',', $data->getWeekdays());

		return $result;
	}

	public static function checkCode($id,$code){
		$query = Teachers::simpleQuery()
		->where('id','!=',$id)
		->where('code',$code)
		->first();

		return $query;
	}

	public static function list(){
		$query = Teachers::simpleQuery()
		->select('id','code','name','subjects','position')
		->get();

		return $query;
	}

	public static function listByDate($date){
		$query = Teachers::simpleQuery()
		->where('weekdays','like','%'.$date->format('l').'%')
		->select('id','code','name')
		->get();

		return $query;
	}

	public static function listCalendar(){
		$query = Teachers::simpleQuery()
		->orderBy('code','asc')
		->get();

		return $query;
	}

	public static function schedule($code,$date){
		$query = Teachers::simpleQuery()
		->where('code',$code)
		->where('weekdays','like','%'.dt($date)->format('l').'%')
		->first();

		return $query;
	}

	public static function qrcode($data){
		$query = Teachers::simpleQuery()
		->whereIn('code',explode(',', $data))
		->get();

		return $query;
	}
}
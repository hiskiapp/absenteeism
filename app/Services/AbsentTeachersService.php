<?php
namespace App\Services;

use DB;
use App\Repositories\TeachersRepository;
use App\Repositories\AbsentTeachersRepository;

class AbsentTeachersService
{
    // TODO : Make you own service method
	public static function list($date){
		$date = dt($date);
		$data = TeachersRepository::listByDate($date);
		foreach ($data as $key => $row) {
			$absent = AbsentTeachersRepository::data($row->id,$date);
			if ($absent) {
				$row->time_in = $absent->time_in;
				$row->type 	  = $absent->type;
				$row->photo   = $absent->photo;
			}else{
				$row->time_in = NULL;
				$row->type 	  = 'Belum Absen';
				$row->photo   = NULL;
			}
		}

		return $data;
	}
}
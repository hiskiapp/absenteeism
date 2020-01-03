<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsentStudents;
use App\Models\Students;

class ApiController extends Controller
{
	public function postAddScan(){
		$nis 	 = g('member_id');
		$student = Students::simpleQuery()
		->where('nis',$nis)
		->first();

		if (!$student) {
			$result['api_status'] 		= 0;
			$result['api_message']  	= 'Kode Tidak Ditemukan!';
		}else{
			$check 	 = AbsentStudents::simpleQuery()
			->where('students_id',$student->id)
			->whereDate('date',date('Y-m-d'))
			->first();

			if (!$check) {
				if (date('Y-m-d H:i:s') >= date('Y-m-d 05:00:00') && date('Y-m-d H:i:s') <= date('Y-m-d 08:00:00')) {
					$new = New AbsentStudents;
					$new->setStudentsId($student->id);

					if (date('Y-m-d H:i:s') <= date('Y-m-d').' '.getSettings('time_in')) {
						$type = 'Tepat Waktu';
					}else{
						$type = 'Terlambat';
					}

					$new->setType($type);
					$new->setIsOut(0);
					$new->setDate(date('Y-m-d'));
					$new->setTimeIn(date('H:i:s'));
					$new->save();

					$result['api_status'] 		= 1;
					$result['api_message']  	= $student->name.' Berhasil Absen Masuk! Tercatat Pukul '.date('H:i:s').'. Status: '.$type;
				}else{
					$result['api_status'] 		= 0;
					$result['api_message']  	= 'Belum Saatnya Absen! Absen Masuk Hanya Dilaksanakan Pada Pukul 05.00 - 07.00 WIB!';
				}
			}else{
				if (date('Y-m-d H:i:s') <= date('Y-m-d 16:00:00')) {
					$result['api_status']  	= 0;
					$result['api_message'] 	= 'Belum Saatnya Pulang!';
				}else{
					if ($check->is_out == 1 || $check->is_out == NULL) {
						$result['api_status']  	= 0;
						$result['api_message'] 	= 'Siswa Sudah Absen!';
					}else{
						$update = AbsentStudents::simpleQuery()
						->where('students_id',$student->id)
						->whereDate('date',date('Y-m-d'))
						->update([
							'is_out' => 1
						]);

						$result['api_status'] 	= 1;
						$result['api_message'] 	= 'Berhasil Absen Keluar!';
					}
				}
			}
		}

		return response()->json($result);
	}
}

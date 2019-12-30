<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsentStudents;
use App\Models\Students;

class ApiController extends Controller
{
	public function postAbsent(){
		$postdata = json_decode(g('code'));

		if(!$postdata){
			$result['api_status'] 		= 0;
			$result['api_message']  	= 'Kode Tidak Valid!';
		}else{
			if ($postdata->type == 'student') {
				$nis 	 = nisdecrypt($postdata->code);
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
						$result['api_message']  	= 'Berhasil Absen Masuk!';
					}else{
						if (date('Y-m-d H:i:s') <= date('Y-m-d 16:00:00')) {
							$result['api_status']  	= 0;
							$result['api_message'] 	= 'Belum Saatnya Pulang!';
						}else{
							if ($check->is_out == 1) {
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
			}
		}

		return response()->json($result);
	}
}

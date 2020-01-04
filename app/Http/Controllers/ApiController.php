<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsentStudents;
use App\Models\Students;

class ApiController extends Controller
{
	public function postAddScan(){
		if (isholiday()) {
			$result['api_status'] = 0;
			$result['api_message'] = 'Ini Hari Libur! Ngeteh Asw! Dasar Gabut Woi!';
		}else{
			$nis = g('member_id');
			$student = Students::simpleQuery()
			->where('nis',$nis)
			->first();

			if (!$student) {
				$result['api_status'] = 0;
				$result['api_message'] = 'Kode Tidak Ditemukan!';
			}else{
				$check = AbsentStudents::simpleQuery()
				->where('students_id',$student->id)
				->whereDate('date',date('Y-m-d'))
				->first();

				$time_in = dt(date('Y-m-d').' '.getSettings('time_in'));
				$time_out = dt(date('Y-m-d').' '.getSettings('time_out'));
				$start_time = dt(date('Y-m-d').' '.getSettings('time_in'))->subHours(2);
				$finish_time = dt(date('Y-m-d').' '.getSettings('time_in'))->addHours(1);

				if (!$check) {
					if (now() >= $start_time && now() <= $finish_time) {
						$new = New AbsentStudents;
						$new->setStudentsId($student->id);

						if (now() <= $time_in) {
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
						$result['api_message']  	= 'Belum Saatnya Absen! Absen Masuk Hanya Dilaksanakan Pada Pukul '.$start_time->format('H:i').' - '.$finish_time->format('H:i');
					}
				}else{
					if ($check->is_out == NULL || $check->is_out == 1) {
						$result['api_status']  	= 0;
						$result['api_message'] 	= 'Siswa Sudah Absen!';
					}else{
						if (now() <= $time_out) {
							$result['api_status']  	= 0;
							$result['api_message'] 	= 'Belum Saatnya Pulang!';
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

		return response()->json($result);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsentStudents;
use App\Models\Students;
use App\Models\AbsentTeachers;
use App\Models\Teachers;

class ApiController extends Controller
{
	public function postAddScan(){
		if (isholiday()) {
			$result['api_status'] = 0;
			$result['api_message'] = 'Saat Ini Hari Libur!';
		}else{
			$code = g('member_id');
			$student = Students::simpleQuery()
			->where('nis',$code)
			->first();

			if (!$student) {
				$teacher = Teachers::simpleQuery()
				->where('id',$code)
				->first();

				if (!$teacher) {
					$result['api_status'] = 0;
					$result['api_message'] = 'Kode Tidak Ditemukan!';
				}else{
					$weekdays = Teachers::simpleQuery()
					->where('id',$teacher->id)
					->where('weekdays','like','%'.now()->format('l').'%')
					->first();

					if (!$weekdays) {
						$result['api_status'] = 0;
						$result['api_message'] = 'Tidak Ada Jadwal Pada Hari Ini!';
					}else{
						$check = AbsentTeachers::simpleQuery()
						->where('teachers_id',$teacher->id)
						->whereDate('date',now()->format('Y-m-d'))
						->first();

						$time_in = dt(now()->format('Y-m-d').' '.getSettings('time_in_teacher'));
						$time_out = dt(now()->format('Y-m-d').' '.getSettings('time_out_teacher'));
						$start_time = dt(now()->format('Y-m-d').' '.getSettings('time_in_teacher'))->subHours(2);
						$finish_time = dt(now()->format('Y-m-d').' '.getSettings('time_in_teacher'))->addHours(1);

						if (!$check) {
							if (now() >= $start_time && now() <= $finish_time) {
								$new = New AbsentTeachers;
								$new->setTeachersId($teacher->id);

								if (now() <= $time_in) {
									$type = 'Tepat Waktu';
								}else{
									$type = 'Terlambat';
								}

								$new->setType($type);
								$new->setIsOut(0);
								$new->setDate(now()->format('Y-m-d'));
								$new->setTimeIn(now()->format('H:i:s'));
								$new->save();

								$result['api_status'] 		= 1;
								$result['api_message']  	= $teacher->name.' Berhasil Absen Masuk! Tercatat Pukul '.now()->format('H:i:s').'. Status: '.$type;
							}else{
								$result['api_status'] 		= 0;
								$result['api_message']  	= 'Belum Saatnya Absen! Absen Masuk Hanya Dilaksanakan Pada Pukul '.$start_time->format('H:i').' - '.$finish_time->format('H:i');
							}
						}else{
							if ($check->is_out == NULL || $check->is_out == 1) {
								$result['api_status']  	= 0;
								$result['api_message'] 	= 'Guru / Karyawan Sudah Absen!';
							}else{
								if (now() <= $time_out) {
									$result['api_status']  	= 0;
									$result['api_message'] 	= 'Belum Saatnya Pulang!';
								}else{
									$update = AbsentTeachers::simpleQuery()
									->where('teachers_id',$teacher->id)
									->whereDate('date',now()->format('Y-m-d'))
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
			}else{
				$check = AbsentStudents::simpleQuery()
				->where('students_id',$student->id)
				->whereDate('date',now()->format('Y-m-d'))
				->first();

				$time_in = dt(now()->format('Y-m-d').' '.getSettings('time_in'));
				$time_out = dt(now()->format('Y-m-d').' '.getSettings('time_out'));
				$start_time = dt(now()->format('Y-m-d').' '.getSettings('time_in'))->subHours(2);
				$finish_time = dt(now()->format('Y-m-d').' '.getSettings('time_in'))->addHours(1);

				if (!$check) {
					if (now()->gte($start_time) && $finish_time->gte($finish_time)) {
						$new = New AbsentStudents;
						$new->setStudentsId($student->id);

						if (now() <= $time_in) {
							$type = 'Tepat Waktu';
						}else{
							$type = 'Terlambat';
						}

						$new->setType($type);
						$new->setIsOut(0);
						$new->setDate(now()->format('Y-m-d'));
						$new->setTimeIn(now()->format('H:i:s'));
						$new->save();

						$result['api_status'] 		= 1;
						$result['api_message']  	= $student->name.' Berhasil Absen Masuk! Tercatat Pukul '.now()->format('H:i:s').'. Status: '.$type;
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
							->whereDate('date',now()->format('Y-m-d'))
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

	public function postAddScanTeachers(){
		if (isholiday()) {
			$result['api_status'] = 0;
			$result['api_message'] = 'Saat Ini Hari Libur!';
		}else{
			$id = g('member_id');
			$teacher = Teachers::simpleQuery()
			->where('id',$id)
			->first();

			if (!$teacher) {
				$result['api_status'] = 0;
				$result['api_message'] = 'Kode Tidak Ditemukan!';
			}else{
				$weekdays = Teachers::simpleQuery()
				->where('id',$teacher->id)
				->where('weekdays','like','%'.now()->format('l').'%')
				->first();

				if (!$weekdays) {
					$result['api_status'] = 0;
					$result['api_message'] = 'Tidak Ada Jadwal Pada Hari Ini!';
				}else{
					$check = AbsentTeachers::simpleQuery()
					->where('teachers_id',$teacher->id)
					->whereDate('date',now()->format('Y-m-d'))
					->first();

					$time_in = dt(now()->format('Y-m-d').' '.getSettings('time_in'));
					$time_out = dt(now()->format('Y-m-d').' '.getSettings('time_out'));
					$start_time = dt(now()->format('Y-m-d').' '.getSettings('time_in'))->subHours(2);
					$finish_time = dt(now()->format('Y-m-d').' '.getSettings('time_in'))->addHours(1);

					if (!$check) {
						if (now() >= $start_time && now() <= $finish_time) {
							$new = New AbsentTeachers;
							$new->setTeachersId($teacher->id);

							if (now() <= $time_in) {
								$type = 'Tepat Waktu';
							}else{
								$type = 'Terlambat';
							}

							$new->setType($type);
							$new->setIsOut(0);
							$new->setDate(now()->format('Y-m-d'));
							$new->setTimeIn(now()->format('H:i:s'));
							$new->save();

							$result['api_status'] 		= 1;
							$result['api_message']  	= $teacher->name.' Berhasil Absen Masuk! Tercatat Pukul '.now()->format('H:i:s').'. Status: '.$type;
						}else{
							$result['api_status'] 		= 0;
							$result['api_message']  	= 'Belum Saatnya Absen! Absen Masuk Hanya Dilaksanakan Pada Pukul '.$start_time->format('H:i').' - '.$finish_time->format('H:i');
						}
					}else{
						if ($check->is_out == NULL || $check->is_out == 1) {
							$result['api_status']  	= 0;
							$result['api_message'] 	= 'Guru / Karyawan Sudah Absen!';
						}else{
							if (now() <= $time_out) {
								$result['api_status']  	= 0;
								$result['api_message'] 	= 'Belum Saatnya Pulang!';
							}else{
								$update = AbsentTeachers::simpleQuery()
								->where('teachers_id',$teacher->id)
								->whereDate('date',now()->format('Y-m-d'))
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

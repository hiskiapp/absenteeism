<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsentStudents;
use App\Models\Students;
use App\Repositories\LogBackendRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Rombels;
use Artisan;

class AbsentController extends Controller
{
	// Students
	public function getStudentsCalendar(){
		$data['page_title'] 	  = 'Absensi Kehadiran Siswa';
		$data['page_description'] = 'Kalenderisasi Absensi Siswa';
		$data['sidebar_type'] 	  = 'mini-sidebar';
		$data['all_month'] 		  = AbsentStudents::simpleQuery()->get()
		->groupBy(function($d){
			return dt($d->created_at)->format('m');
		});
		$data['all_year']		  = AbsentStudents::simpleQuery()->get()
		->groupBy(function($d){
			return dt($d->created_at)->format('Y');
		});
		
		$data['rombels']		  = Rombels::all();

		if (g('rombels_id')) {
			$data['students'] 	  = Students::simpleQuery()
			->where('rombels_id',g('rombels_id'))
			->orderBy('name','asc')
			->get();
		}else{
			$data['students'] 	  = Students::simpleQuery()
			->where('rombels_id',1)
			->orderBy('name','asc')
			->get();
		}

		if (g('year')) {
			$data['dates'] = allDates(g('year'),g('month'));
		}else{
			$data['dates'] = allDates();
		}


		return view('absent.students.calendar', $data);
	}

	public function getStudentsList(){
		$data['page_title'] 	  = 'List Absensi Siswa';

		if (g('date')) {
			$date = dt(g('date'));
			$data['data'] = AbsentStudents::simpleQuery()
			->join('students','students.id','=','absent_students.students_id')
			->join('rombels','students.rombels_id','=','rombels.id')
			->whereDate('absent_students.date',dateDb(g('date')))
			->whereNotIn('absent_students.type',['Tepat Waktu'])
			->select('students.nis as nis','students.name as name','rombels.name as rombel','absent_students.type as type')
			->get();
		}else{
			$date = Carbon::now();
			$data['data'] = AbsentStudents::simpleQuery()
			->join('students','students.id','=','absent_students.students_id')
			->join('rombels','students.rombels_id','=','rombels.id')
			->whereDate('absent_students.date',date('Y-m-d'))
			->whereNotIn('absent_students.type',['Tepat Waktu'])
			->select('students.nis as nis','students.name as name','rombels.name as rombel','absent_students.type as type')
			->get();
		}

		$data['date'] = $date->format('m/d/Y');
		$data['page_description'] = 'Absensi Tanggal '.$date->format('d F Y');
		$data['rombels'] = Rombels::all();

		return view('absent.students.list',$data);
	}

	public function postAddStudentsAbsent(){
		$data = Students::findByNis(g('nis'));
		$check = AbsentStudents::simpleQuery()
		->where('students_id',$data->getId())
		->whereDate('date',dateDb(g('add-date')))
		->first();

		if ($check) {
			AbsentStudents::simpleQuery()
			->where('students_id',$data->getId())
			->whereDate('date',dateDb(g('add-date')))
			->update([
				'is_out' => NULL,
				'type' => g('add-type')
			]);
		}else{
			$new = New AbsentStudents;
			$new->setDate(dateDb(g('add-date')));
			$new->setTimeIn(NULL);
			$new->setStudentsId($data->getId());
			$new->setType(g('add-type'));
			$new->setIsOut(NULL);
			$new->save();
		}

		$log['action'] = 'Create';
		$log['page'] = 'List Absensi Siswa';
		$log['description'] = 'Menambahkan Absen '.$data->getName().' Dengan Status: '.g('add-type');
		LogBackendRepository::add($log);

		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Data Berhasil Disimpan!']);
	}

	// public function getMarkStudentsAlpa(){
	// 	Artisan::call('set:alpa');

	// 	if (substr(Artisan::output(), 6, 2) == 'is') {
	// 		return redirect()->back()->with(['message_type' => 'error', 'message' => 'Tidak Ada Yang Ditandai!']);
	// 	}

	// 	$log['action'] = 'Create';
	// 	$log['page'] = 'List Absent Siswa';
	// 	$log['description'] = 'Menandai Absen Siswa Yang Alpa';
	// 	LogBackendRepository::add($log);

	// 	return redirect()->back()->with(['message_type' => 'success', 'message' => 'Berhasil Menandai Siswa Yang Alpa!']);
	// }

	// public function getMarkStudentsBolos(){
	// 	Artisan::call('set:bolos');

	// 	if (substr(Artisan::output(), 6, 2) == 'is') {
	// 		return redirect()->back()->with(['message_type' => 'error', 'message' => 'Tidak Ada Yang Ditandai!']);
	// 	}

	// 	if ($count == 0) {
	// 		return redirect()->back()->with(['message_type' => 'error', 'message' => 'Tidak Ada Yang Ditandai!']);
	// 	}

	// 	$log['action'] = 'Create';
	// 	$log['page'] = 'List Absent Siswa';
	// 	$log['description'] = 'Menandai Absen Siswa Yang Bolos';
	// 	LogBackendRepository::add($log);

	// 	return redirect()->back()->with(['message_type' => 'success', 'message' => 'Berhasil Menandai Siswa Yang Bolos!']);
	// }

	//Teachers
	public function getTeachersCalendar(){
		return view('errors.maintenance');
	}
	public function getTeachersList(){
		return view('errors.maintenance');
	}

}

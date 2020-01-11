<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsentStudents;
use App\Models\Students;
use App\Models\Rombels;
use App\Repositories\LogBackendRepository;
use App\Repositories\AbsentStudentsRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Artisan;

class AbsentStudentsController extends Controller
{
	public function getList(){
		$data['page_title'] 	  = 'List Absensi Siswa';

		if (g('date')) {
			$date = dt(g('date'));
		}else{
			$date = Carbon::now();
		}

		$data['data'] = AbsentStudentsRepository::list($date);
		$data['date'] = $date->format('m/d/Y');
		$data['page_description'] = 'Absensi Tanggal '.$date->format('d F Y');
		$data['rombels'] = Rombels::all();

		return view('absent.students.list',$data);
	}

	public function postAdd(Request $request){
		$data = Students::findByNis(g('nis'));
		$check = AbsentStudentsRepository::check($data->getId(),g('add-date'));

		if ($check) {
			$update = AbsentStudentsRepository::update($data->getId(),g('add-date'));

			if ($request->hasFile('photo')) {
				$image = $request->file('photo');
				$image_name = time().uniqid().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('data/absent/'.date('Y').'/'.date('m'));
				$image->move($destinationPath, $image_name);

				$result_image = 'data/absent/'.date('Y').'/'.date('m').'/'.$image_name;
			}else{
				$result_image = NULL;
			}

			if (g('add-type') == 'Tepat Waktu') {
				$update->update([
					'time_in' => now()->format('H:i:s'),
					'is_out' => NULL,
					'type' => g('add-type')
				]);
			}elseif (g('add-type') == 'Terlambat') {
				$update->update([
					'time_in' => now()->format('H:i:s'),
					'is_out' => NULL,
					'type' => g('add-type')
				]);
			}else{
				$update->update([
					'time_in' => NULL,
					'is_out' => NULL,
					'type' => g('add-type'),
					'photo' => $result_image
				]);
			}

		}else{
			$new = New AbsentStudents;
			$new->setDate(dateDb(g('add-date')));
			$new->setStudentsId($data->getId());
			$new->setType(g('add-type'));
			$new->setIsOut(NULL);

			if ($request->hasFile('photo')) {
				$image = $request->file('photo');
				$image_name = time().uniqid().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('data/absent/'.date('Y').'/'.date('m'));
				$image->move($destinationPath, $image_name);

				$result_image = 'data/absent/'.date('Y').'/'.date('m').'/'.$image_name;
				$new->setPhoto($result_image);
			}

			if (g('add-type') == 'Tepat Waktu') {
				$new->setTimeIn(now()->format('H:i:s'));
			}elseif (g('add-type') == 'Terlambat') {
				$new->setTimeIn(now()->format('H:i:s'));
			}else{
				$new->setTimeIn(NULL);
			}

			$new->save();
		}

		$log['action'] = 'Create';
		$log['page'] = 'List Absensi Siswa';
		$log['description'] = 'Menambahkan Absen '.$data->getName().' Dengan Status: '.g('add-type');
		LogBackendRepository::add($log);

		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Data Berhasil Disimpan!']);
	}

	public function getAlpa(){
		Artisan::call('set:alpa --type=students');

		if (substr(Artisan::output(), 6, 2) == 'is') {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Tidak Ada Yang Ditandai!']);
		}

		$log['action'] = 'Create';
		$log['page'] = 'List Absent Siswa';
		$log['description'] = 'Menandai Absen Siswa Yang Alpa';
		LogBackendRepository::add($log);

		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Berhasil Menandai Siswa Yang Alpa!']);
	}

	public function getBolos(){
		Artisan::call('set:bolos --type=students');

		if (substr(Artisan::output(), 6, 2) == 'is') {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Tidak Ada Yang Ditandai!']);
		}

		$log['action'] = 'Create';
		$log['page'] = 'List Absent Siswa';
		$log['description'] = 'Menandai Absen Siswa Yang Bolos';
		LogBackendRepository::add($log);

		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Berhasil Menandai Siswa Yang Bolos!']);
	}

	public function getCalendar(){
		$data['page_title'] 	  = 'Absensi Kehadiran Siswa';
		$data['page_description'] = 'Kalenderisasi Absensi Siswa';
		$data['sidebar_type'] 	  = 'mini-sidebar';
		$data['all_month'] 		  = AbsentStudentsRepository::listFilter('m');
		$data['all_year']		  = AbsentStudentsRepository::listFilter('Y');
		$data['rombels']		  = Rombels::all();
		$data['students'] 	  	  = StudentsRepository::listByRombel(g('rombels_id'));

		if (g('year')) {
			$data['dates'] = allDates(g('year'),g('month'));
		}else{
			$data['dates'] = allDates();
		}


		return view('absent.students.calendar', $data);
	}
}
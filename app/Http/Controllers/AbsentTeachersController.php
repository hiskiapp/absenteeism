<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsentTeachers;
use App\Models\Teachers;
use App\Repositories\TeachersRepository;
use App\Repositories\AbsentTeachersRepository;
use App\Repositories\LogBackendRepository;
use App\Services\AbsentTeachersService;
use Artisan;
use DataTables;

class AbsentTeachersController extends Controller
{
	public function getList(){
		$data['page_title'] 	  = 'List Absensi Guru / Karyawan';
		$date = dt(g('date'));
		$data['data'] = AbsentTeachersService::list($date);
		$data['date'] = $date->format('m/d/Y');
		$data['page_description'] = 'Absensi Tanggal '.$date->format('d F Y');

		return view('absent.teachers.list',$data);
	}

	public function getJson(){
		$data = AbsentTeachersService::list(g('date'));

		return DataTables::of($data)
		->editColumn("type", function ($data) {
			if ($data->type == "Tepat Waktu") {
				$label = 'success';
			}elseif ($data->type == "Terlambat") {
				$label = 'warning';
			}elseif ($data->type == "Sakit") {
				$label = 'danger';
			}elseif ($data->type == "Izin") {
				$label = 'info';
			}elseif ($data->type == "Tanpa Keterangan") {
				$label = 'primary';
			}elseif ($data->type == "Bolos") {
				$label = 'success';
			}else{
				$label = 'warning';
			}

			$result = '<span class="label label-'.$label.'">'.$data->type.'</span>';

			if ($data->photo) {
				$result .= ' <a href="'.url($data->photo).'" data-toggle="lightbox" data-title="'.$data->name.'" data-footer="Keterangan: '.$data->type.'"><span class="label label-success">Lihat Bukti</span></a>';
			}

			return $result;
		})
		->editColumn("time_in", function ($data) {
			if ($data->time_in) {
				return $data->time_in;
			}else{
				return '-';
			}
		})
		->escapeColumns([])
		->make(true);
	}

	public function postAdd(Request $request){
		if (isholiday(g('add-date'))) {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Tidak Bisa Menambahkan Saat Hari Libur!']);
		}

		$data = Teachers::findByCode(g('code'));

		$schedule = TeachersRepository::schedule(g('code'),g('add-date'));

		if (!$schedule) {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Tidak Ada Jadwal Pada Saat Itu!']);
		}

		$check = AbsentTeachersRepository::check($data->getId(),g('add-date'));

		if ($check) {
			$update = AbsentTeachersRepository::update($data->getId(),g('add-date'));

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
					'type' => g('add-type'),
					'photo' => NULL
				]);
			}elseif (g('add-type') == 'Terlambat') {
				$update->update([
					'time_in' => now()->format('H:i:s'),
					'is_out' => NULL,
					'type' => g('add-type'),
					'photo' => NULL
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
			$new = New AbsentTeachers;
			$new->setDate(dateDb(g('add-date')));
			$new->setTeachersId($data->getId());
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
				$new->setPhoto(NULL);
			}elseif (g('add-type') == 'Terlambat') {
				$new->setTimeIn(now()->format('H:i:s'));
				$new->setPhoto(NULL);
			}else{
				$new->setTimeIn(NULL);
			}

			$new->save();
		}

		$log['action'] = 'Create';
		$log['page'] = 'List Absensi Guru / Karyawan';
		$log['description'] = 'Menambahkan Absen Guru / Karyawan '.$data->getName().' Dengan Status: '.g('add-type');
		LogBackendRepository::add($log);

		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Data Berhasil Disimpan!']);
	}

	public function getAlpa(){
		Artisan::call('set:alpa --type=teachers');

		if (substr(Artisan::output(), 6, 2) == 'is') {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Tidak Ada Yang Ditandai!']);
		}

		$log['action'] = 'Create';
		$log['page'] = 'List Absent Guru / Karyawan';
		$log['description'] = 'Menandai Absen Guru / Karyawan Yang Alpa';
		LogBackendRepository::add($log);

		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Berhasil Menandai Guru / Karyawan Yang Alpa!']);
	}

	public function getBolos(){
		Artisan::call('set:bolos --type=teachers');

		if (substr(Artisan::output(), 6, 2) == 'is') {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Tidak Ada Yang Ditandai!']);
		}

		$log['action'] = 'Create';
		$log['page'] = 'List Absent Guru / Karyawan';
		$log['description'] = 'Menandai Absen Guru / Karyawan Yang Bolos';
		LogBackendRepository::add($log);

		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Berhasil Menandai Guru / Karyawan Yang Bolos!']);
	}

	public function getCalendar(){
		$data['page_title'] 	  = 'Absensi Kehadiran Guru / Karyawan';
		$data['page_description'] = 'Kalenderisasi Absensi Guru / Karyawan';
		$data['sidebar_type'] 	  = 'mini-sidebar';
		$data['all_month'] 		  = AbsentTeachers::simpleQuery()->get()
		->groupBy(function($d){
			return dt($d->date)->format('m');
		});

		$data['all_year']		  = AbsentTeachers::simpleQuery()->get()
		->groupBy(function($d){
			return dt($d->date)->format('Y');
		});

		$data['teachers'] 	  	  = TeachersRepository::listCalendar();

		if (g('year')) {
			$data['dates'] = allDates(g('year'),g('month'));
		}else{
			$data['dates'] = allDates();
		}

		return view('absent.teachers.calendar', $data);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AbsentStudentsRepository;
use App\Repositories\LogBackendRepository;
use App\Repositories\StudentsRepository;
use App\Repositories\TeachersRepository;
use App\Repositories\NotificationsRepository;
use App\Services\AbsentStudentsService;
use App\Services\AbsentTeachersService;
use DataTables;

class JsonController extends Controller
{
	public function getAbsentStudents(){
		$data = AbsentStudentsRepository::list(g('date'));

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
		->addColumn("status", function ($data) {
			if ($data->is_out != NULL) {
				if ($data->is_out == 1) {
					return '<div class="btn-group" role="group" aria-label="Action">
					<div class="btn-group" role="group">
					<button id="btn-action" type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Sudah Pulang
					</button>
					<div class="dropdown-menu" aria-labelledby="btn-action">
					<a class="dropdown-item" href="javascript:void(0)" onclick="setout('.$data->id.',0)">Set Belum Pulang</a>
					</div>';
				}else{
					return '<div class="btn-group" role="group" aria-label="Action">
					<div class="btn-group" role="group">
					<button id="btn-action" type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Belum Pulang
					</button>
					<div class="dropdown-menu" aria-labelledby="btn-action">
					<a class="dropdown-item" href="javascript:void(0)" onclick="setout('.$data->id.')">Set Sudah Pulang</a>
					</div>';
				}

			}else{
				return '-';
			}
		})
		->escapeColumns([])
		->make(true);
	}

	public function getAbsentTeachers(){
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

	public function getLog(){
		$data = LogBackendRepository::list(g('date'));

		return DataTables::of($data)
		->editColumn("action", function ($data) {
			if ($data->action == 'Create') {
				$btn = 'success';
			}elseif ($data->action == 'Update') {
				$btn = 'info';
			}elseif ($data->action == 'Read') {
				$btn = 'primary';
			}else{
				$btn = 'danger';
			}
			return '<span class="btn btn-'.$btn.' btn-xs">'.$data->action.'</span>';
		})
		->addColumn("datetime", function ($data) {
			return dt($data->created_at)->format('d-m-Y H:i');
		})
		->addColumn('info', function ($data) {
			return timeHumanReadable($data->created_at);
		})
		->make(true);
	}

	public function getStudents(){
		$data = StudentsRepository::list();


		return DataTables::of($data)
		->addColumn("action", function ($data) {
			return '<a href="students/edit/'.$data->id.'" class="btn btn-xs btn-warning text-white"><i class="fas fa-pencil-alt"></i></a>
			<button onclick="deleteRow('.$data->id.')" class="btn btn-xs btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
			<a href="students/detail/'.$data->id.'" class="btn btn-xs btn-info text-white"><i class="fas fa-eye"></i></a>';
		})
		->make(true);
	}

	public function getTeachers(){
		$data = TeachersRepository::list();

		return DataTables::of($data)
		->editColumn("subjects", function ($data){
			$subjects = explode(',',$data->subjects);
			
			$result = '';
			foreach ($subjects as $row) {
				$result .= '<span class="btn btn-info btn-xs">'.$row.'</span> ';
			}

			return $result;
		})
		->editColumn("position", function ($data){
			$position = explode(',',$data->position);
			
			$result = '';
			foreach ($position as $row) {
				$result .= '<span class="btn btn-info btn-xs">'.$row.'</span> ';
			}

			return $result;
		})
		->addColumn("action", function ($data) {
			return '<a href="teachers/edit/'.$data->id.'" class="btn btn-xs btn-warning text-white"><i class="fas fa-pencil-alt"></i></a>
			<button onclick="deleteRow('.$data->id.')" class="btn btn-xs btn-danger text-white"><i class="fas fa-trash-alt"></i></button>
			<a href="teachers/detail/'.$data->id.'" class="btn btn-xs btn-info text-white"><i class="fas fa-eye"></i></a>';
		})
		->escapeColumns([])
		->make(true);
	}

	public function getNotifications(){
		$data = NotificationsRepository::list();

		return DataTables::of($data)
		->addColumn("time", function ($data) {
			return timeHumanReadable($data->created_at);
		})
		->addColumn("status", function ($data) {
			if ($data->is_read) {
				return '<span class="badge badge-success">Sudah Dibaca</a>';
			}else{
				return '<a href="'.url('notifications/go').'/'.$data->id.'" class="badge badge-secondary">Belum Dibaca</a>';
			}
		})
		->escapeColumns([])
		->make(true);

	}
}

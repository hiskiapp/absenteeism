<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Repositories\LogBackendRepository;
use Session;
use Validator;
use Excel;
use File;
use App\Imports\TeachersImport;

class EmployeesController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'Data Karyawan';
		$data['page_description'] = 'Kumpulan Data Karyawan SMK Wikrama 1 Jepara';
		// $data['sidebar_type'] = "mini-sidebar";
		$data['data'] = Teachers::findAllByIsTeacher(0);

		return view('employees.index',$data);
	}

	public function getAdd(){
		$data['page_title'] = 'Tambah Data Karyawan';
		$data['page_description'] = 'Silahkan Isi Form Berikut Dengan Benar & Tepat';

		return view('employees.form',$data);
	}

	public function postAdd(Request $request){
		$check = Teachers::findByCode($request->code);

		if ($check->getId()) {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Kode Telah Digunakan!'])->withInput($request->input());
		}

		$new = New Teachers;
		$new->setCode($request->code);
		$new->setName(ucwords(strtolower($request->name)));
		$new->setSubjects(NULL);
		$new->setPosition($request->position);
		$new->setIsTeacher(0);

		$address['city'] = ucwords(strtolower($request['city']));
		$address['district'] = ucwords(strtolower($request['district']));
		$address['village'] = ucwords(strtolower($request['village']));
		$address['rt'] = $request['rt'];
		$address['rw'] = $request['rw'];

		$new->setAddress(json_encode($address));
		$new->save();

		$log['action'] = 'Create';
		$log['page'] = 'Data Karyawan';
		$log['description'] = 'Menambahkan Data Karyawan Baru: '.$request->name;
		LogBackendRepository::add($log);

		return redirect('employees')->with(['message_type' => 'success', 'message' => 'Data Berhasil Disimpan!']);
	}

	public function getEdit($id){
		$data['page_title'] = 'Tambah Data Karyawan';
		$data['page_description'] = 'Silahkan Isi Form Berikut Dengan Benar & Tepat';
		$data['data'] = Teachers::findById($id);
		$data['address'] = json_decode($data['data']->getAddress());
		$subjects = Teachers::simpleQuery()
		->select('subjects')
		->groupBy('subjects')
		->get();

		return view('employees.form',$data);
	}

	public function postEdit(Request $request, $id){
		$check = Teachers::findByCode($request->code);

		if ($check->getId()) {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Kode Telah Digunakan!'])->withInput($request->input());
		}
		
		$edit = Teachers::findById($id);
		$edit->setCode($request->code);
		$edit->setName(ucwords(strtolower($request->name)));
		$edit->setPosition($request->position);

		$address['city'] = ucwords(strtolower($request['city']));
		$address['district'] = ucwords(strtolower($request['district']));
		$address['village'] = ucwords(strtolower($request['village']));
		$address['rt'] = $request['rt'];
		$address['rw'] = $request['rw'];

		$edit->setAddress(json_encode($address));
		$edit->save();

		$log['action'] = 'Update';
		$log['page'] = 'Data Karyawan';
		$log['description'] = 'Mengedit Data Karyawan: '.$request->name;
		LogBackendRepository::add($log);

		return redirect('employees')->with(['message_type' => 'info', 'message' => 'Data Berhasil Diupdate!']);
	}

	public function getDelete($id){
		$data = Teachers::findById($id);

		$log['action'] = 'Delete';
		$log['page'] = 'Data Karyawan';
		$log['description'] = 'Menghapus Data Karyawan: '.$data->getName();
		LogBackendRepository::add($log);

		$data->delete();

		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Data Berhasil Dihapus!']);
	}

	public function getDetail($id){
		$data['page_title'] = 'Detail Karyawan';
		$data['data'] = Teachers::findById($id);
		$data['address'] = json_decode($data['data']->getAddress());

		return view('employees.detail', $data);
	}

	public function postExport(Request $request){
		$extension = File::extension($request->file('file_export')->getClientOriginalName());
		if($extension == "xlsx" || $extension == "xls"){
			$save = Excel::import(new TeachersImport, $request->file('file_export'));
			if($save){
				$log['action'] = 'Create';
				$log['page'] = 'Data Karyawan';
				$log['description'] = 'Mengimport Data Karyawan Baru';
				LogBackendRepository::add($log);

				return redirect()->back()->with(['message_type' => 'info', 'message' => 'Berhasil Mengimport Data!']);
			}else{
				return redirect()->back()->with(['message_type' => 'error', 'message' => 'Failed!']);
			}
		}else {
			return redirect()->back()->with(['message_type' => 'info', 'message' => 'Extensi Harus .xls Atau .xlxs!']);
		}
	}
}

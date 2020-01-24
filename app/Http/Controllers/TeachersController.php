<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Repositories\TeachersRepository;
use App\Repositories\LogBackendRepository;
use App\Imports\TeachersImport;
use Session;
use Validator;
use Excel;
use File;
use DataTables;
use QrCode;

class TeachersController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'Data Guru / Karyawan';
		$data['page_description'] = 'Kumpulan Data Guru / Karyawan SMK Wikrama 1 Jepara';

		return view('teachers.index',$data);
	}

	public function getAdd(){
		$data['page_title'] = 'Tambah Data Guru / Karyawan';
		$data['page_description'] = 'Silahkan Isi Form Berikut Dengan Benar & Tepat';
		$data['subjects'] = TeachersRepository::subjects();

		return view('teachers.form',$data);
	}

	public function postAdd(Request $request){
		$check = Teachers::findByCode($request->code);

		if ($check->getId()) {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Kode Telah Digunakan!'])->withInput($request->input());
		}

		$new = New Teachers;
		$new->setCode($request->code);
		$new->setName(ucwords(strtolower($request->name)));
		$new->setSubjects($request->subjects);
		$new->setPosition($request->position);
		$new->setWeekdays(implode(',',$request->weekdays));
		$new->setIsTeacher(NULL);

		$address['city'] = ucwords(strtolower($request['city']));
		$address['district'] = ucwords(strtolower($request['district']));
		$address['village'] = ucwords(strtolower($request['village']));
		$address['rt'] = $request['rt'];
		$address['rw'] = $request['rw'];

		$new->setAddress(json_encode($address));
		$new->save();

		$log['action'] = 'Create';
		$log['page'] = 'Data Guru / Karyawan';
		$log['description'] = 'Menambahkan Data Guru / Karyawan Baru: '.$request->name;
		LogBackendRepository::add($log);

		return redirect('teachers')->with(['message_type' => 'success', 'message' => 'Data Berhasil Disimpan!']);
	}

	public function getEdit($id){
		$data['page_title'] = 'Tambah Data Guru / Karyawan';
		$data['page_description'] = 'Silahkan Isi Form Berikut Dengan Benar & Tepat';
		$data['data'] = Teachers::findById($id);
		$data['address'] = json_decode($data['data']->getAddress());
		$data['subjects'] = TeachersRepository::subjects();
		$data['weekdays'] = TeachersRepository::weekdays($id);

		return view('teachers.form',$data);
	}

	public function postEdit(Request $request, $id){
		$check = TeachersRepository::checkCode($id,$request->code);

		if ($check) {
			return redirect()->back()->with(['message_type' => 'error', 'message' => 'Kode Telah Digunakan!'])->withInput($request->input());
		}

		$edit = Teachers::findById($id);
		$edit->setCode($request->code);
		$edit->setName(ucwords(strtolower($request->name)));
		$edit->setSubjects($request->subjects);
		$edit->setPosition($request->position);
		$edit->setWeekdays(implode(',',$request->weekdays));

		$address['city'] = ucwords(strtolower($request['city']));
		$address['district'] = ucwords(strtolower($request['district']));
		$address['village'] = ucwords(strtolower($request['village']));
		$address['rt'] = $request['rt'];
		$address['rw'] = $request['rw'];

		$edit->setAddress(json_encode($address));
		$edit->save();

		$log['action'] = 'Update';
		$log['page'] = 'Data Guru / Karyawan';
		$log['description'] = 'Mengedit Data Guru / Karyawan: '.$request->name;
		LogBackendRepository::add($log);

		return redirect('teachers')->with(['message_type' => 'info', 'message' => 'Data Berhasil Diupdate!']);
	}

	public function postDelete($id){
		$data = Teachers::findById($id);

		$log['action'] = 'Delete';
		$log['page'] = 'Data Guru / Karyawan';
		$log['description'] = 'Menghapus Data Guru / Karyawan: '.$data->getName();
		LogBackendRepository::add($log);

		$data->delete();

		$result['ajax_status'] = 1;
        $result['ajax_message'] = 'Data Berhasil Dihapus!';

        return response()->json($result);
	}

	public function getDetail($id){
		$data['page_title'] = 'Detail Guru / Karyawan';
		$data['data'] = Teachers::findById($id);
		$data['address'] = json_decode($data['data']->getAddress());
		$data['qrcode'] = $id;
		$data['weekdays'] = explode(',', $data['data']->getWeekdays());

		return view('teachers.detail', $data);
	}

	public function postImport(Request $request){
		$extension = File::extension($request->file('file_export')->getClientOriginalName());
		if($extension == "xlsx" || $extension == "xls"){
			$save = Excel::import(new TeachersImport, $request->file('file_export'));
			if($save){
				$log['action'] = 'Create';
				$log['page'] = 'Data Guru / Karyawan';
				$log['description'] = 'Mengimport Data Guru / Karyawan Baru';
				LogBackendRepository::add($log);

				return redirect()->back()->with(['message_type' => 'info', 'message' => 'Berhasil Mengimport Data!']);
			}else{
				return redirect()->back()->with(['message_type' => 'error', 'message' => 'Failed!']);
			}
		}else {
			return redirect()->back()->with(['message_type' => 'info', 'message' => 'Extensi Harus .xls Atau .xlxs!']);
		}
	}

	public function postQrCode(){
		$data['page_title'] = 'Cetak QR Code Teachers';

		if (g('data_type') == 'All') {
            $data['data'] = Teachers::all();
        }else{
        	$data['data'] = TeachersRepository::qrcode(g('data'));
        }

		return view('teachers.qrcode',$data);
	}
}

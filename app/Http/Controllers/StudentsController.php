<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Rombels;
use App\Models\Rayons;
use App\Repositories\StudentsRepository;
use App\Repositories\LogBackendRepository;
use App\Imports\StudentsImport;
use Session;
use Validator;
use Excel;
use File;
use Hash;
use QrCode;
use DataTables;

class StudentsController extends Controller
{
    public function getIndex(){
    	$data['page_title'] = 'Data Siswa';
    	$data['page_description'] = 'Kumpulan Data Siswa SMK Wikrama 1 Jepara';
        $data['sidebar_type'] = "mini-sidebar";
        $data['data'] = Students::all();
        $data['rombels'] = Rombels::all();
        $data['rayons'] = Rayons::all();
        
        return view('students.index',$data);
    }

    public function getAdd(){
    	$data['page_title'] = 'Tambah Data Siswa';
        $data['page_description'] = 'Silahkan Isi Form Berikut Dengan Benar & Tepat';
        $data['rombels'] = Rombels::all();
        $data['rayons'] = Rayons::all();
        $data['birth_city'] = StudentsRepository::birthCity();

        return view('students.form',$data);
    }

    public function postAdd(Request $request){
        $check = Students::findByNis($request->nis);

        if ($check->getId()) {
            return redirect()->back()->with(['message_type' => 'error', 'message' => 'NIS Telah Digunakan!'])->withInput($request->input());
        }

        $new = New Students;
        $new->setNis($request->nis);
        $new->setName(ucwords(strtolower($request->name)));
        $new->setGender($request->gender);
        $new->setRombelsId($request->rombel_id);
        $new->setRayonsId($request->rayons_id);
        $new->setBirthCity(ucwords(strtolower($request->birth_city)));
        $new->setBirthDate(dateDb($request->birth_date));
        $new->setReligion($request->religion);

        $address['city'] = ucwords(strtolower($request['city']));
        $address['district'] = ucwords(strtolower($request['district']));
        $address['village'] = ucwords(strtolower($request['village']));
        $address['rt'] = $request['rt'];
        $address['rw'] = $request['rw'];

        $new->setAddress(json_encode($address));
        $new->setNameOfGuardian(ucwords(strtolower($request->name_of_guardian)));
        $new->save();

        $log['action'] = 'Create';
        $log['page'] = 'Data Siswa';
        $log['description'] = 'Menambahkan Data Siswa Baru: '.$request->name;
        LogBackendRepository::add($log);

        return redirect('students')->with(['message_type' => 'success', 'message' => 'Data Berhasil Disimpan!']);
    }

    public function getEdit($id){
        $data['page_title'] = 'Tambah Data Siswa';
        $data['page_description'] = 'Silahkan Isi Form Berikut Dengan Benar & Tepat';
        $data['data'] = Students::findById($id);
        $data['address'] = json_decode($data['data']->getAddress());
        $data['rombels'] = Rombels::all();
        $data['rayons'] = Rayons::all();
        $data['birth_city'] = StudentsRepository::birthCity();
        return view('students.form',$data);
    }

    public function postEdit(Request $request, $id){
        $check = Students::simpleQuery()
        ->where('id','!=',$id)
        ->where('nis',$request->nis)
        ->first();

        if ($check) {
            return redirect()->back()->with(['message_type' => 'error', 'message' => 'NIS Telah Digunakan!'])->withInput($request->input());
        }

        $edit = Students::findById($id);
        $edit->setNis($request->nis);
        $edit->setName(ucwords(strtolower($request->name)));
        $edit->setGender($request->gender);
        $edit->setRombelsId($request->rombel_id);
        $edit->setRayonsId($request->rayons_id);
        $edit->setBirthCity(ucwords(strtolower($request->birth_city)));
        $edit->setBirthDate(dateDb($request->birth_date));
        $edit->setReligion($request->religion);

        $address['city'] = ucwords(strtolower($request['city']));
        $address['district'] = ucwords(strtolower($request['district']));
        $address['village'] = ucwords(strtolower($request['village']));
        $address['rt'] = $request['rt'];
        $address['rw'] = $request['rw'];

        $edit->setAddress(json_encode($address));
        $edit->setNameOfGuardian(ucwords(strtolower($request->name_of_guardian)));
        $edit->save();

        $log['action'] = 'Update';
        $log['page'] = 'Data Siswa';
        $log['description'] = 'Mengedit Data Siswa: '.$request->name;
        LogBackendRepository::add($log);

        return redirect('students')->with(['message_type' => 'info', 'message' => 'Data Berhasil Diupdate!']);
    }

    public function getDelete($id){
        $data = Students::findById($id);

        $log['action'] = 'Delete';
        $log['page'] = 'Data Siswa';
        $log['description'] = 'Menghapus Data Siswa: '.$data->getName();
        LogBackendRepository::add($log);

        $data->delete();

        return redirect()->back()->with(['message_type' => 'success', 'message' => 'Data Berhasil Dihapus!']);
    }

    public function getDetail($id){
        $data['page_title'] = 'Detail Siswa';
        $data['data'] = Students::findById($id);
        $data['address'] = json_decode($data['data']->getAddress());
        $data['qrcode'] = strval($data['data']->getNis());

        return view('students.detail', $data);
    }

    public function postImport(Request $request){
        $extension = File::extension($request->file('file_export')->getClientOriginalName());
        if($extension == "xlsx" || $extension == "xls"){
            $save = Excel::import(new StudentsImport, $request->file('file_export'));
            if($save){
                $log['action'] = 'Create';
                $log['page'] = 'Data Siswa';
                $log['description'] = 'Mengimport Data Siswa Baru';
                LogBackendRepository::add($log);

                return redirect()->back()->with(['message_type' => 'info', 'message' => 'Berhasil Mengimport Data!']);
            }else{
                return redirect()->back()->with(['message_type' => 'error', 'message' => 'Failed!']);
            }
        }else {
            return redirect()->back()->with(['message_type' => 'info', 'message' => 'Extensi Harus .xls Atau .xlxs!']);
        }
    }

    public function getJson(){
        $data = StudentsRepository::json();

        return DataTables::of($data)->make(true);
    }
}

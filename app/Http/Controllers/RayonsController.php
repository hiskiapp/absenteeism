<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rayons;
use App\Repositories\RayonsRepository;
use App\Repositories\LogBackendRepository;

class RayonsController extends Controller
{
    public function getIndex(){
		$data['page_title'] = 'Data Rayon';
		$data['data'] = Rayons::all();

		foreach ($data['data'] as $key => $row) {
			$row->count = RayonsRepository::count($row->id);
		}

		return view('rayons.index', $data);
	}

	public function getEdit($id){
		$data = RayonsRepository::data($id);

		return response()->json($data);
	}

	public function postAdd(Request $request){
		$new = New Rayons;
		$new->setName($request->name);
		$new->save();

		$log['action'] = 'Create';
        $log['page'] = 'Data Rayon';
        $log['description'] = 'Menambahkan Data Rayon Baru: '.$request->name;
        LogBackendRepository::add($log);

		return redirect('rayons')->with(['message_type' => 'success', 'message' => 'Data Berhasil Disimpan!']);
	}

	public function postEdit(Request $request, $id){
		$edit = Rayons::findById($id);
		$edit->setName($request->edit_name);
		$edit->save();

		$log['action'] = 'Update';
        $log['page'] = 'Data Rayon';
        $log['description'] = 'Mengedit Data Rayon: '.$request->edit_name;
        LogBackendRepository::add($log);

        return redirect('rayons')->with(['message_type' => 'success', 'message' => 'Data Berhasil Diupdate!']);
	}

	public function getDelete($id){
		$data = Rayons::findById($id);

		$log['action'] = 'Delete';
        $log['page'] = 'Data Rayon';
        $log['description'] = 'Menghapus Data Rayon: '.$data->getName();
        LogBackendRepository::add($log);

		$data->delete();
		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Data Berhasil Dihapus!']);
	}
}

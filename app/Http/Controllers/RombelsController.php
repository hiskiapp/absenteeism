<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rombels;
use App\Repositories\RombelsRepository;
use App\Repositories\LogBackendRepository;

class RombelsController extends Controller
{
	public function getIndex(){
		$data['page_title'] = 'Data Rombel';
		$data['data'] = Rombels::all();

		foreach ($data['data'] as $key => $row) {
			$row->count = RombelsRepository::count($row->id);
		}

		return view('rombels.index', $data);
	}

	public function getEdit($id){
		$data = Rombels::simpleQuery()
		->where('id', $id)
		->first();

		return response()->json($data);
	}

	public function postAdd(Request $request){
		$new = New Rombels;
		$new->setName($request->name);
		$new->save();

		$log['action'] = 'Create';
        $log['page'] = 'Data Rombel';
        $log['description'] = 'Menambahkan Data Rombel Baru: '.$request->name;
        LogBackendRepository::add($log);

		return redirect('rombels')->with(['message_type' => 'success', 'message' => 'Data Berhasil Disimpan!']);
	}

	public function postEdit(Request $request, $id){
		$edit = Rombels::findById($id);
		$edit->setName($request->edit_name);
		$edit->save();

		$log['action'] = 'Update';
        $log['page'] = 'Data Rombel';
        $log['description'] = 'Mengedit Data Rombel: '.$request->edit_name;
        LogBackendRepository::add($log);

        return redirect('rombels')->with(['message_type' => 'success', 'message' => 'Data Berhasil Diupdate!']);
	}

	public function getDelete($id){
		$data = Rombels::findById($id);

		$log['action'] = 'Delete';
        $log['page'] = 'Data Rombel';
        $log['description'] = 'Menghapus Data Rombel: '.$data->getName();
        LogBackendRepository::add($log);

		$data->delete();
		return redirect()->back()->with(['message_type' => 'success', 'message' => 'Data Berhasil Dihapus!']);
	}
}

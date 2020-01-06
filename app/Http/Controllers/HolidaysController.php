<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holidays;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class HolidaysController extends Controller
{
    public function getIndex(){
    	$data['page_title'] = 'Data Tanggal Libur';
    	$data['data'] = Holidays::simpleQuery()->orderBy('date','asc')->get();

    	return view('holidays.index',$data);
    }

    public function	postAdd(){
    	$date = explode(' - ', g('date-range'));
        $date_start = dt($date[0]);
        $date_end = dt($date[1]);
    	$for = CarbonPeriod::create($date_start,$date_end);

    	foreach ($for as $key => $row) {
    		$new = New Holidays;
    		$new->setDate($row->format('Y-m-d'));
    		$new->setDescription(g('description'));
    		$new->save();
    	}

    	return redirect()->back()->with(["message_type" => "success", "message" => "Data Hari Libur Berhasil Ditambah!"]);
    }

    public function	getEdit($id){
    	$data = Holidays::simpleQuery()
    	->where('id',$id)
    	->first();

        $data->date = dt($data->date)->format('m/d/Y');

    	return response()->json($data);
    }

    public function	postEdit($id){
    	$edit = Holidays::findById($id);
    	$edit->setDate(dt(g('edit_date')));
    	$edit->setDescription(g('edit_description'));
    	$edit->save();

    	return redirect()->back()->with(["message_type" => "success", "message" => "Data Hari Libur Berhasil Diupdate!"]);
    }

    public function	getDelete($id){
    	$data = Holidays::findById($id);
    	$data->delete();

    	return redirect()->back()->with(["message_type" => "success", "message" => "Data Hari Libur Berhasil Dihapus!"]);
    }
}

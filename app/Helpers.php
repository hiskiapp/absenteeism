<?php

use Carbon\Carbon;
use App\Repositories\LogBackendRepository;
use App\Repositories\NotificationsRepository;
use App\Repositories\AbsentStudentsRepository;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Settings;
use Carbon\CarbonPeriod;
use App\Models\AbsentStudents;
use App\Models\AbsentTeachers;
use App\Models\Holidays;
use App\Models\Teachers;

function app_name()
{
	return getSettings('title');
}

function dt($date)
{
	return Carbon::parse($date);
}

function g($name) {
	return Request::get($name);
}

function getSettings($slug)
{
	$find = Settings::findBySlug($slug);
	return $find->getContent();
}

function dateFormat($date)
{
	return dt($date)->format('d F Y');
}

function dateDb($date)
{
	return dt($date)->format('Y-m-d');
}

function datePicker($date)
{
	return dt($date)->format('d-m-Y');
}

function timeFormat($date)
{
	return dt($date)->format('H:i');
}

function activityTimeline()
{
	return LogBackendRepository::timeline();
}

function notifHead(){
	return NotificationsRepository::head();
}

function notifHeadCount(){
	return NotificationsRepository::count(true);
}

function timeHumanReadable($date)
{
	return dt($date)->diffForHumans();
}

function dateExcel($date)
{
	$parse = Date::excelToDateTimeObject($date);
	return Carbon::parse($parse)->format('Y-m-d');
}

function allDates($year = null, $month = null)
{
	if ($year == null || $month == null) {
		$start = Carbon::now()->startOfMonth();
		$end = Carbon::now()->endOfMonth();
	}else{
		$date_start = $year.'-'.$month.'-01';
		$start = Carbon::parse($date_start);

		$dim = Carbon::createFromDate($year, $month)->daysInMonth;
		$date_end = $year.'-'.$month.'-'.$dim;
		$end = Carbon::parse($date_end);
	}

	$period = CarbonPeriod::create($start, $end);
	return $period;
}

function routeController($prefix, $controller)
{

	$prefix = trim($prefix, '/').'/';

	if(substr($controller,0,1) != "\\") {
		$controller = "\App\Http\Controllers\\".$controller;
	}

	$exp = explode("\\", $controller);
	$controller_name = end($exp);

	try {
		Route::get($prefix, ['uses' => $controller.'@getIndex', 'as' => $controller_name.'GetIndex']);

		$controller_class = new \ReflectionClass($controller);
		$controller_methods = $controller_class->getMethods(\ReflectionMethod::IS_PUBLIC);
		$wildcards = '/{one?}/{two?}/{three?}/{four?}/{five?}';
		foreach ($controller_methods as $method) {

			if ($method->class != 'Illuminate\Routing\Controller' && $method->name != 'getIndex') {
				if (substr($method->name, 0, 3) == 'get') {
					$method_name = substr($method->name, 3);
					$slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
					$slug = strtolower(implode('-', $slug));
					$slug = ($slug == 'index') ? '' : $slug;
					Route::get($prefix.$slug.$wildcards, ['uses' => $controller.'@'.$method->name, 'as' => $controller_name.'Get'.$method_name]);
				} elseif (substr($method->name, 0, 4) == 'post') {
					$method_name = substr($method->name, 4);
					$slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
					Route::post($prefix.strtolower(implode('-', $slug)).$wildcards, [
						'uses' => $controller.'@'.$method->name,
						'as' => $controller_name.'Post'.$method_name,
					]);
				}
			}
		}
	} catch (\Exception $e) {

	}
}

function nisencrypt($value){
	return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($value)))));
}

function nisdecrypt($value){
	return base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($value)))));
}

function colorabsent($id,$date,$is_teacher = null){
	if ($is_teacher) {
		$check = Teachers::simpleQuery()
		->where('id',$id)
		->where('weekdays','like','%'.$date->format('l').'%')
		->first();

		$data = AbsentTeachers::simpleQuery()
		->where('teachers_id',$id)
		->whereDate('date',$date)
		->first();

		if (!$check) {
			$type = 'Tidak Ada Jadwal';
		}elseif($data){
			$type = $data->type;
		}

	}else{
		$data = AbsentStudents::simpleQuery()
		->where('students_id',$id)
		->whereDate('date',$date)
		->first();

		if ($data) {
			$type = $data->type;
		}else{
			$type = NULL;
		}
	}

	if ($data) {
		if ($type == "Tepat Waktu") {
			return '#1CA58F';
		}elseif ($type == "Terlambat") {
			return '#FFAF0E';
		}elseif ($type == "Sakit") {
			return '#EB4C4C';
		}elseif ($type == "Izin") {
			return '#2585E4';
		}elseif ($type == 'Tanpa Keterangan') {
			return '#563DEA';
		}elseif ($type == 'Bolos') {
			return '#6C757D';
		}elseif ($type == 'Tidak Ada Jadwal') {
			return '#F2F2F2';
		}
	}else{
		if (isset($type)) {
			return '#F2F2F2';
		}else{
			return '';
		}
	}
}

function absentstatistict($id,$type,$is = null){
	if ($is) {
		$data = AbsentTeachers::simpleQuery()
		->where('teachers_id',$id)
		->where('type',$type)
		->get();
	}else{
		$data = AbsentStudents::simpleQuery()
		->where('students_id',$id)
		->where('type',$type)
		->get();
	}

	return $data->count();
}

function absentstat($type,$date,$is = null){
	if ($is) {
		$data = AbsentTeachers::simpleQuery()
		->where('type',$type)
		->whereDate('date',dateDb($date))
		->get();
	}else{
		$data = AbsentStudents::simpleQuery()
		->where('type',$type)
		->whereDate('date',dateDb($date))
		->get();
	}
	return $data->count();
}

function isholiday($date = null){
	if ($date) {
		$date = Carbon::parse($date);
	}else{
		$date = now();
	}
	
	$check = Holidays::simpleQuery()->whereDate('date',$date->format('Y-m-d'))->first();

	if ($check) {
		return true;
	}elseif($date->isWeekend()){
		return true;
	}else{
		return false;
	}
}

function statindv($id,$type,$date){
	return AbsentStudentsRepository::statIndv($id,$type,$date);
}
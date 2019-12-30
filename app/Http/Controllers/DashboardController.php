<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getIndex(){
    	$data['page_title'] = 'Dashboard';

    	return view('dashboard',$data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Session;

class UsersController extends Controller
{
    public function getIndex(){
    	$data['page_title'] = "Pengaturan User";
    	$data['data'] = Users::all();

        dd($data['data']);

    	return view('users.index',$data);
    }

    public function postIndex(){
    	$edit = Users::findById(1);
    	$edit->setPhoto(g('photo'));
    	$edit->setName(g('name'));
    	$edit->setEmail(g('email'));
    	$edit->setPassword(g('password_confirmation'));
    	$edit->save();

    	return redirect()->back()->with(['message_type' => 'success','message' => 'Data Berhasil Diupdate!']);
    }
}

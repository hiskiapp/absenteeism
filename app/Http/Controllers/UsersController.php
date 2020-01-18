<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Session;
use Hash;

class UsersController extends Controller
{
    public function getIndex(){
    	$data['page_title'] = "Pengaturan User";
    	$data['data'] = Users::simpleQuery()->first();

    	return view('users.index',$data);
    }

    public function postAdd(Request $request){
    	$edit = Users::findById(1);
        if (Hash::check(g('password_confirmation'),$edit->getPassword())) {
            if ($request->image) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);

                $edit->setPhoto('images/'.$imageName);
            }else{
                $edit->setName(g('name'));
                $edit->setEmail(g('email'));
            }

            $edit->save();
            
            return redirect()->back()->with(['message_type' => 'success','message' => 'Data Berhasil Diupdate!']);
        }else{
            return redirect()->back()->with(['message_type' => 'error','message' => 'Password Konfirmasi Salah!']);
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Admin;

class AdminController extends Controller
{
    
    public function login(){
        return view('admin.login');
    }

    public function store(Request $request)
    {   
        if(Auth::attempt(['user' => $request->get('user'),'user_type' => 2,'password' => $request->get('password')])){
            return redirect()->to('admin/dashboard');
        } else {
            return redirect()->back();
        }
    }

    public function destroy(){
        Auth::logout();
        return redirect()->to('admin');
    }

    public function showDashboard(){
        return view('admin.dashboard');
    }
}

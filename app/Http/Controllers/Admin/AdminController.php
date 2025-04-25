<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // var_dump($data);
            if(Auth::guard('admin')->attempt([
                'email'=>$data['email'],
                'password'=>$data['password'
                ]])) {
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->back()->with('error', 'Invalid Email or Password');
            }
         }    
        return view('admin.login');
}
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
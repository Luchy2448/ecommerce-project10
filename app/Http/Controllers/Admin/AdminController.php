<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

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
            $rules = [
                'email'=>'required|email|max:255',
                'password'=>'required|min:6|max:20',
            ];
            $customMessages = [
                'email.required'=>'Email is required',
                'email.email'=>'Valid Email is required',
                'password.required'=>'Password is required',
            ];

            $this->validate($request, $rules, $customMessages);

            if(Auth::guard('admin')->attempt([
                'email'=>$data['email'],
                'password'=>$data['password'],
                ])) {
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
         }    
        return view('admin.login');
}
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
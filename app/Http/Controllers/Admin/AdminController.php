<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
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
    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // Check if current password is correct;
            if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
                // check if new password and confirm password are matching
                if($data['new_pwd'] == $data['confirm_pwd']){
                    //  Update new password
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    return redirect()->back()->with('success_message', 'Password has been changed successfully');
                }else{
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password are not matching');
                    }         
            }else{
                return redirect()->back()->with('error_message', 'Current Password is incorrect');
                }
         }    
        return view('admin.update_password');
    }
    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        };
    }
    public function updateDetails(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
        //    echo "<pre>"; print_r($data); die;
           
            $rules = [
                'admin_name'=>'required|max:255|regex:/^[\pL\s]+$/u',
                'admin_mobile'=>'required|numeric|min:10|regex:/^\+?[0-9]+$/',
            ];
            $customMessages = [
                'admin_name.required'=>'Name is required',
                'admin_mobile.required'=>'Mobile is required',
                'admin_mobile.numeric'=>'Valid mobile is required',
                // 'admin_mobile.max'=>'Mobile maximum number should be 11 digits',
                'admin_mobile.min'=>'Mobile minimum number should be 10 digits',
            ];

            $this->validate($request, $rules, $customMessages);

            // Update Admin details
            Admin::where('email', Auth::guard('admin')->user()->email)
                  ->update([
                    'name'=>$data['admin_name'],
                    'mobile'=>$data['admin_mobile']
                ]);
                return redirect()->back()->with('success_message', 'Admin details have been changed successfully');
         }    
        return view('admin.update_admin_details');
    }
    // public function checkAdmin(){
    //     if(Auth::guard('admin')->check()){
    //         return 'true';
    //     }else{
    //         return 'false';
    //     }
    // }
    // public function forgotPassword(Request $request){
    //     if($request->isMethod('post')){
    //         $data = $request->all();
    //         // echo "<pre>"; print_r($data); die;
    //         $rules = [
    //             'email'=>'required|email|max:255',
    //         ];
    //         $customMessages = [
    //             'email.required'=>'Email is required',
    //             'email.email'=>'Valid Email is required',
    //         ];

    //         $this->validate($request, $rules, $customMessages);

    //         return redirect()->back()->with('success_message', 'Password reset link has been sent to your email');
    //      }    
    //     return view('admin.forgot_password');
    // }
}
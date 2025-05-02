<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;




class AdminController extends Controller
{
    public function dashboard()
    {   
        Session::put('page', 'dashboard');
        // dd(Session::get('page'));
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|min:6|max:20',
            ];
            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required',
            ];

            $this->validate($request, $rules, $customMessages);

            if (Auth::guard('admin')->attempt([
                'email' => $data['email'],
                'password' => $data['password'],
            ])) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function updatePassword(Request $request)
    {   
        Session::put('page', 'update_password');

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'current_pwd' => 'required|min:6|max:20',
                'new_pwd' => 'required|min:6|max:20',
                'confirm_pwd' => 'required|same:new_pwd',
            ];
    
            $customMessages = [
                'current_pwd.required' => 'Current Password is required',
                'current_pwd.min' => 'Current Password must be at least 6 characters',
                'current_pwd.max' => 'Current Password must not exceed 20 characters',
                'new_pwd.required' => 'New Password is required',
                'new_pwd.min' => 'New Password must be at least 6 characters',
                'new_pwd.max' => 'New Password must not exceed 20 characters',
                'confirm_pwd.required' => 'Confirm Password is required',
                'confirm_pwd.same' => 'Confirm Password must match the New Password',
            ];
    
            // Run validation
            $this->validate($request, $rules, $customMessages);

            
                 // Check if current password is correct
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            // Check if new password and confirm password are matching
            if ($data['new_pwd'] == $data['confirm_pwd']) {
                // Update new password
                Admin::where('id', Auth::guard('admin')->user()->id)
                    ->update(['password' => bcrypt($data['new_pwd'])]);

                return redirect()->back()->with('success_message', 'Password has been changed successfully');
            } else {
                return redirect()->back()->with('error_message', 'New Password and Confirm Password are not matching');
            }
        } else {
            return redirect()->back()->with('error_message', 'Current Password is incorrect');
        }
    }
    return view('admin.update_password');
}

    public function checkCurrentPassword(Request $request)
    {   
        

        $data = $request->all();

        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }
    
public function updateDetails(Request $request)
{
    Session::put('page', 'update-details');


    if ($request->isMethod('post')) {
        $data = $request->all();

        $rules = [
            'admin_name' => 'required|max:255|regex:/^[\pL\s]+$/u',
            'admin_mobile' => 'required|numeric|min:10|regex:/^\+?[0-9]+$/',
            'admin_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $customMessages = [
            'admin_name.required' => 'Name is required',
            'admin_mobile.required' => 'Mobile is required',
            'admin_mobile.numeric' => 'Valid mobile is required',
            'admin_mobile.min' => 'Mobile minimum number should be 10 digits',
            'admin_image.image' => 'Valid image is required',
            'admin_image.mimes' => 'Valid image is required',
            'admin_image.max' => 'Image size should be less than 2MB',
        ];

        $this->validate($request, $rules, $customMessages);

        // Upload image
        if ($request->hasFile('admin_image')) {
            $image_tmp = $request->file('admin_image');
            // Obtain the current admin image
            $currentImage = Auth::guard('admin')->user()->image;

            // Delete the current image if it exists
            if (!empty($currentImage)) {
                $currentImagePath = public_path('admin/images/photos/' . $currentImage);
                if (file_exists($currentImagePath)) {
                    unlink($currentImagePath);
                }
            }

            if ($image_tmp->isValid()) {
                // Generate new image name
                $imageName = rand(111, 99999) . '.' . $image_tmp->getClientOriginalExtension();
                // Define the path to save the image
                $image_path = public_path('admin/images/photos/');
                // Move the image to the specified path
                $image_tmp->move($image_path, $imageName);
            }
        }

        // Update Admin details
        Admin::where('email', Auth::guard('admin')->user()->email)
            ->update([
                'name' => $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image' => $imageName ?? Auth::guard('admin')->user()->image, // maintain the existing image if no new image is uploaded
            ]);

        return redirect()->back()->with('success_message', 'Admin details have been changed successfully');
    }
    return view('admin.update_admin_details');
}
  
}
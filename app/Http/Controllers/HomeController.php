<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){
        $admins=Admin::get();
        return view('Home.AdminTable',compact('admins'));
    }
    public function register (){
        $employees=Employee::get();
        $seats=Seat::get();
        return view('Home.Register',compact('employees','seats'));
    }

    
    public function login (){
        return view('Home.Login');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'employee_id' => 'required|exists:employees,id|unique:admins,employee_id',
            'number' => 'required|exists:seats,number|unique:admins,number',
        ]);

        $admin = Admin::create([
            'password' => Hash::make($validatedData['password']),
            'email' => $validatedData['email'],
            'employee_id' => $validatedData['employee_id'], 
            'number' => $validatedData['number'],
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('queue');
    }
    
    public function save(Request $request)
    {
    
        $emailValidator = Validator::make($request->only('email'), [
            'email' => 'exists:admins,email|min:10|required',
        ], [
            'email.exists' => 'الايميل ليس مسجلاً',
            'email.required' => 'هذا الحقل مطلوب',
            'email.min' => 'الايميل يجب أن يتألف من 10 محارف أو أكثر',
        ]);
    
        if ($emailValidator->fails()) {
            return redirect()->back()->withErrors($emailValidator->errors());
        }
    
        $passwordValidator = Validator::make($request->only('password'), [
            'password' => 'required|min:8'
        ], [
            'password.required' => 'هذا الحقل مطلوب',
            'password.min' => 'كلمة السر يجب أن تتألف من 8 محارف أو أكثر'
        ]);
    
        if ($passwordValidator->fails()) {
            return redirect()->back()->withErrors($passwordValidator->errors());
        }
    
        $data = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('queue');
        }
    
        return redirect()->back()->withErrors(['email' => 'The provided credentials are incorrect.']);
    }
    
    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Logged out successfully');
    }

   /*public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $employees = Employee::get();
        return view('Home.Edit', compact('admin', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validatedData = $request->validate([
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'sometimes|min:6',
            'employee_id' => 'required|exists:employees,id',
        ]);

        $admin->email = $validatedData['email'];
        $admin->employee_id = $validatedData['employee_id'];

        if (!empty($validatedData['password'])) {
            $admin->password = Hash::make($validatedData['password']);
        }

        $admin->save();

        return redirect()->route('department')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('department')->with('success', 'Admin deleted successfully.');
    }*/
}
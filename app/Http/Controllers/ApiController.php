<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNumberRequest;
use App\Models\Service;
use App\Models\User;
use App\Rules\TrueEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    /*public function numberRegister(Request $request){
    
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:4', 
        'phone_number' => 'required|unique:users,phone_number|regex:/^09[0-9]{8}$/',
        'password' => 'required|min:8', 
    ],[
        'phone_number.required'=> 'هذا الحقل مطلوب',
            'phone_number.unique'=> 'الرقم مسجل مسبقاً',
            'phone_number.regex'=> 'يجب أن يتكون الرقم من 10 خانات وأن يبدأ ب 09',
            'name.required'=> 'هذا الحقل مطلوب',
            'name.min'=> 'الاسم يجب أن يتألف من 4 محارف أو أكثر',
            'password.required'=> 'هذا الحقل مطلوب',
            'password.min'=> 'كلمة السر يجب أن تتألف من 8 محارف أو أكثر',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user = User::create([
        'name' => $request->name,
        'phone_number' => $request->phone_number,
        'password' => Hash::make($request->password)
    ],);

    Auth::login($user);

    
    return response()->json($request, 201);
}

public function numberLogin(Request $request)
{
    $phoneValidator = Validator::make($request->only('phone_number'), [
        'phone_number' => 'exists:users,phone_number|regex:/^09[0-9]{8}$/|required',
    ], [
        'phone_number.exists' => 'الرقم ليس مسجلاً',
        'phone_number.required' => 'هذا الحقل مطلوب',
        'phone_number.regex' => 'يجب أن يتكون الرقم من 10 خانات وأن يبدأ ب 09',
    ]);

    if ($phoneValidator->fails()) {
        return response()->json($phoneValidator->errors(), 422);
    }
    $passwordValidator = Validator::make($request->only('password'),[
        'password'=>'required|min:8'
    ],[
        'password.required'=>'هذا الحقل مطلوب',
        'password.min'=>'كلمة السر يجب أن تتألف من 8 محارف أو أكثر'
    ]);
    if ($passwordValidator->fails()) {
        return response()->json($passwordValidator->errors(), 422);
    }

    $data = $request->only(['phone_number', 'password']);
    if (Auth::attempt($data)) {
        return response()->json($data, 200);
    }

    return response()->json('كلمة السر خاطئة', 422);
}*/

public function emailRegister(Request $request){
    
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:4', 
        'email' => 'required|email:rcf,dns|unique:users,email|min:10',
        'password' => 'required|min:8', 
    ],[
        'email.required'=> 'هذا الحقل مطلوب',
        'email.unique'=> 'الايميل مسجل مسبقاً',
        'email.min'=> 'الايميل يجب أن يتألف من 10 محارف أو أكثر',
        'name.required'=> 'هذا الحقل مطلوب',
        'name.min'=> 'الاسم يجب أن يتألف من 4 محارف أو أكثر',
        'password.required'=> 'هذا الحقل مطلوب',
        'password.min'=> 'كلمة السر يجب أن تتألف من 8 أحرف أو أكثر',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ],);

    Auth::login($user);

    
    return response()->json($request, 201);
}

public function emailLogin(Request $request)
{
    $phoneValidator = Validator::make($request->only('email'), [
        'email' => 'exists:users,email|min:10|required',
    ], [
        'email.exists' => 'الايميل ليس مسجلاً',
        'email.required' => 'هذا الحقل مطلوب',
        'email.min' => 'الايميل يجب أن يتألف من 10 محارف أو أكثر',
    ]);

    if ($phoneValidator->fails()) {
        return response()->json($phoneValidator->errors(), 422);
    }
    $passwordValidator = Validator::make($request->only('password'),[
        'password'=>'required|min:8'
    ],[
        'password.required'=>'هذا الحقل مطلوب',
        'password.min'=>'كلمة السر يجب أن تتألف من 8 محارف أو أكثر'
    ]);
    if ($passwordValidator->fails()) {
        return response()->json($passwordValidator->errors(), 422);
    }

    $data = $request->only(['email', 'password']);
    if (Auth::attempt($data)) {
        return response()->json($data, 200);
    }

    return response()->json('كلمة السر خاطئة', 422);
}
    public function logout(){
        Session::flush();
        Auth::logout();
        return response()->json('تم تسجيل الخروج',200);
    }
    
    public function services(){
        $services=Service::pluck('service_name');
        return response()->json($services);
    }

}

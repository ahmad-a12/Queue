<?php
namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\Queue;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Google\Service\Games\RecallToken;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Nette\Iterators\Mapper;


class AppController extends Controller 
{
    public function emailRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:64', 
            'email' => 'required|email|unique:users,email|min:10|max:256',
            'phone_number' => 'required|unique:users,phone_number|regex:/^09[0-9]{8}$/',
            'password' => 'required|min:8', 
        ],[
            'email.required'=> 'هذا الحقل مطلوب',
            'email.unique'=> 'الايميل مسجل مسبقاً',
            'email.min'=> 'الايميل يجب أن يتألف من 10 محارف أو أكثر',
            'phone_number.required'=> 'هذا الحقل مطلوب',
            'phone_number.unique'=> 'الرقم مسجل مسبقاً',
            'phone_number.regex'=> 'يجب أن يتكون الرقم من 10 خانات وأن يبدأ ب 09',
            'name.required'=> 'هذا الحقل مطلوب',
            'name.min'=> 'الاسم يجب أن يتألف من 4 محارف أو أكثر',
            'password.required'=> 'هذا الحقل مطلوب',
            'password.min'=> 'كلمة السر يجب أن تتألف من 8 أحرف أو أكثر',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'verified' => false,
        ]);
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return response()->json([
            'user' =>[$user],
            'token' => $token,
        ], 201);
    }

    public function emailLogin(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'exists:users,email|min:10|required',
            'password'=>'required|min:8',
        ], [
            'email.exists' => 'الايميل ليس مسجلاً',
            'email.required' => 'هذا الحقل مطلوب',
            'email.min' => 'الايميل يجب أن يتألف من 10 محارف أو أكثر',
            'password.required'=>'هذا الحقل مطلوب',
            'password.min'=>'كلمة السر يجب أن تتألف من 8 محارف أو أكثر',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

            if ($user) {
                $data['token'] = $user->fcm_token; 
            }
            $user->fcm_token = $request->fcm_token;
            $user->save();
            return response()->json([
                'user' => [$user],
                'token' => $token,
            ], 200);
        }

        return response()->json('كلمة السر خاطئة', 200);
    }

    public function logout(Request $request)
    {
        Auth::guard('sanctum')->user()->tokens()->delete();
        return response()->json('You have been logged out', 200);
    }

    public function services()
{
    $services = Service::all()
        ->filter(function ($service) {
            return $service->service_name !== 'service';
        })
        ->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->service_name,
                'description' => $service->description
            ];
        })->values(); // Ensure the collection is re-indexed

    return response()->json($services);
}

    



    public function addQueue(Request $request)
{
    $userId = Auth::guard('sanctum')->id();
    $existingQueue = Queue::where('user_id', $userId)
                          ->whereIn('status', ['pending', 'active'])
                          ->first();

    if ($existingQueue) {
        return response()->json(['message' => 'You already have a reserve'], 200);
    }

    $queue = new Queue();
    $queue->service_id = $request->service_id;
    $queue->user_id = $userId;
    $queue->reserved_at=now();
    $queue->expires_at=Carbon::now()->addMinutes(10);
    $queue->save();
    if($queue->user_id && ($queue->status=='pending' || $queue->status=='active')){
        return response()->json(['message'=>'You already have a reserve'],200);
    }

    return response()->json($queue, 200);
}
public function getRemainingTime($queueId)
{
    $queue = Queue::findOrFail($queueId);

    $now = Carbon::now();
    $expiresAt = Carbon::parse($queue->expires_at);

    if ($queue->status == 'active') {
        return response()->json([
            'message' => 'Queue is active.',
            'remaining_time' => 0,
        ], 200);
    }

    if ($now->greaterThanOrEqualTo($expiresAt)) {
        if ($queue->status == 'pending') {
            $expiresAt = $expiresAt->addMinutes(5);
            $queue->expires_at = $expiresAt;
            $queue->save();
        } else {
            return response()->json([
                'message' => 'Queue has expired.',
                'remaining_time' => 0,
            ], 200);
        }
    }

    $remainingTime = $expiresAt->diffInSeconds($now);

    if ($remainingTime == 0 && $queue->status == 'pending') {
        $expiresAt = $expiresAt->addMinutes(5);
        $queue->expires_at = $expiresAt; 
        $queue->save();
        $remainingTime = $expiresAt->diffInSeconds($now);
    }

    return response()->json([
        'message' => 'Remaining time retrieved successfully.',
        'remaining_time' => $remainingTime,
    ], 200);
}

    public function number(string $id){
        $queue = Queue::find($id);
        return response()->json(['seat_number' => $queue->seat_number],200);
    }

}
<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use App\Mail\OtpMail;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(100000, 999999);
        Redis::setex('otp:' . $email, 300, $otp);
        // Replace 'OtpMail' with your actual email class
        Mail::to($email)->send(new OtpMail($otp));
        return response()->json(['message' => 'OTP sent successfully']);
    }
}

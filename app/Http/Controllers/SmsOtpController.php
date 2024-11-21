<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Twilio\Rest\Client;

class SmsOtpController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|phone:AUTO,US'
        ]);

        $phone = $request->input('phone');
        $otp = rand(100000, 999999);

        Redis::setex('otp:' . $phone, 300, $otp);

        $this->twilio->messages->create($phone, [
            'from' => env('TWILIO_PHONE_NUMBER'),
            'body' => "Your OTP code is $otp"
        ]);

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|phone:AUTO,US',
            'otp' => 'required|digits:6'
        ]);

        $phone = $request->input('phone');
        $otp = $request->input('otp');
        $storedOtp = Redis::get('otp:' . $phone);

        if ($storedOtp && $storedOtp == $otp) {
            Redis::del('otp:' . $phone);

            return response()->json(['message' => 'OTP verified successfully']);
        }

        return response()->json(['error' => 'Invalid OTP'], 400);
    }
}

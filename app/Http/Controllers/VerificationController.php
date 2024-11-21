<?php 
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function sendOtp(Request $request,User $user)
    {

        $otp = rand(10000, 99999);
        Redis::setex('otp:' . $user->email, 300, $otp);

        $user->update(['otp' => $otp]);

        Mail::to($user->email)->send(new OtpMail($otp));

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function verifyOtp(Request $request, User $user)
    {
        $request->validate([
            'otp' => 'required|digits:5',
        ]);

        $otp = $request->input('otp');
        $storedOtp = $user->otp;

        if ($storedOtp && $storedOtp == $otp) {
            $user->update(['verified' => true,'email_verified_at'=>now(),'otp'=>null]);

            Redis::del('otp:' . $user->email);

            return response()->json(['message' => 'OTP verified successfully']);
        }

        return response()->json(['error' => 'Invalid OTP'], 400);
    }
}

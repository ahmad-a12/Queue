<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\SmsOtpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\PersonalAccessToken;
use App\Services\MailosaurForwarder;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*Route::post('numberRegister', [ApiController::class,'numberRegister']);
Route::post('numberLogin', [ApiController::class,'numberLogin']);
Route::post('emailRegister', [ApiController::class,'emailRegister']);
Route::post('emailLogin', [ApiController::class,'emailLogin']);
Route::get('logout', [ApiController::class,'logout']);
Route::get('services', [ApiController::class,'services']);*/




Route::post('/register/email', [AppController::class, 'emailRegister']);

Route::post('/login/email', [AppController::class, 'emailLogin'])->middleware(['checkverified','checkbanned']);

Route::post('/logout', [AppController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/services', [AppController::class, 'services']);

Route::get('/number/{id}', [AppController::class, 'number']);

Route::post('/queue/{id}', [AppController::class, 'addQueue'])->middleware(['auth:sanctum' , 'checkbanned']);

Route::get('/remaining/time/{queueId}', [AppController::class, 'getRemainingTime']);

Route::post('/send/email/otp/{user}', [VerificationController::class, 'sendOtp']);//->middleware('auth:sanctum');

Route::post('/verify/email/otp/{user}', [VerificationController::class, 'verifyOtp']);//->middleware('auth:sanctum');//->middleware(['auth:sanctum' , 'checkbanned']);

Route::post('/rate/{id}', [QueueController::class, 'rate']);

Route::get('/notify3/{id}', [QueueController::class, 'notify3'])->name('notify3');

/*
Route::post('/sendOtp',  [OtpController::class, 'sendOtp'])->name('sendOtp');

Route::post('/send/otp', [SmsOtpController::class, 'sendOtp'])->name('send/otp');

Route::post('/verify/otp', [SmsOtpController::class, 'verifyOtp'])->name('verify/otp');*/




/*Route::get('/sendPushNotification/{id}/{fcm_token}', [QueueController::class, 'sendPushNotification'])->name('noti');

Route::get('/notify}', [QueueController::class, 'notify'])->name('notify');

Route::get('/notify2}', [QueueController::class, 'notify2'])->name('notify2');



Route::middleware('auth:sanctum')->group(function () {
    Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});

//Auth::routes(['verify'=>true]);

Route::get('/send-test-email', function () {
    try {
        Mail::raw('This is a test email', function ($message) {
            $message->to('ahmadagha485@gmail.com')->subject('Test Email');
        });

        return 'Test email sent!';
    } catch (\Exception $e) {
        Log::error('Mail sending error: ' . $e->getMessage());
        return 'Failed to send test email. Error: ' . $e->getMessage();
    }
});



Route::get('/test-email', function () {
    $apiKey = 'mEWrFqLbDJLpTwY3A3hTw31tGsx10j4J';
    $serverId = 'cp4qhxh4';
    $recipientEmail = 'ahmadagha345678@gmail.com';

    $forwarder = new MailosaurForwarder($apiKey, $serverId);
    $forwarder->forwardEmails($recipientEmail);

    return 'Email test initiated. Check logs for details.';
});*/
Route::get('/token', function () {
    $token = auth()->createToken('-AuthToken')->plainTextToken;
    return response()->json(['token' => $token]);
});

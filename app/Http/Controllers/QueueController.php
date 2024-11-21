<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Queue;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class QueueController extends Controller
{
    public function index2()
{
    $admin = Auth::guard('admin')->user();
    $employeeService = $admin->employee->service->id;

    $queues = Queue::whereHas('service', function ($query) use ($employeeService) {
        $query->where('id', $employeeService);
    })->get();

    return view('Queue.QueueTable', compact('queues'));
}

    public function index()
    {
        $queues=Queue::get();
        $users=User::get();
        /*$admins = Admin::findOrFail($adminId);
        $services = Service::whereHas('employees', function ($query) use ($admins) {
            $query->where('admin_id', $admins->id);
        })->get();*/
        return view('Queue.QueueTable',compact('queues','users'));
    }

    public function archive()
    {
        $queues=Queue::get();
        $users=User::get();
        return view('Queue.ArchivedQueueTable',compact('queues'),compact('users'));
    }
    
    public function store(Request $request,User $user)
{
    /*if (!Auth::guard('api')->check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }*/
    $queues = new Queue();
    $queues->service_id = $request->service_id;
    $queues->user_id = $user;
    $queues->save();
    return response()->json($queues, 200);
}

    
    public function show(string $id,)
    {
        $queues=Queue::find($id);
        return view('Queue.ShowQueue',compact('queues'));
    }
   
    public function update(Request $request, string $id)
{
    $queue = Queue::find($id);
    $adminId = auth('admin')->id();

    if ($queue) {
        if ($queue->status == 'pending') {
            $queue->status = 'active';
            $queue->admin_id = $adminId;
            $admin = Admin::find($adminId);
            $userToNotify = User::find($queue->user_id);
            if ($userToNotify) {
                $this->notifyStart($userToNotify, $admin->number);
            }
        $queue->seat_number=$admin->number;
        } elseif ($queue->status == 'active' && $queue->admin_id == $adminId) {
            $userToNotify2 = User::find($queue->user_id);
            if ($userToNotify2) {
                $this->notifyEnd($userToNotify2);
            }
            $queue->status = 'finished';
        } else {
            return redirect()->route('queue')->withErrors('Invalid status change or unauthorized admin.');
        }

        $queue->save();
        return redirect()->route('queue');
    }

    return redirect()->route('queue')->withErrors('Queue not found.');
}

public function rate(Request $request, $id)
{
    $validatedData = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:255',
    ]);

    $queue = Queue::find($id);

    if (!$queue) {
        return response()->json(['message' => 'Queue not found'], 404);
    }

    $queue->rating = $validatedData['rating'];
    $queue->comment = $validatedData['comment'];
    $queue->save();

    return response()->json(['message' => 'Queue updated successfully', 'queue' => $queue], 200);
}

public function notifyStart($user,$seatNumber)
{
    \Log::info('User retrieved: ', (array)$user);

    if (!is_object($user) || !isset($user->fcm_token)) {
        return response()->json([
            'message' => 'Invalid user object',
            'error' => 'User must be an object with a non-null fcm_token property',
        ]);
    }

    $factory = (new Factory)->withServiceAccount(config_path('fcm.json'));
    $messaging = $factory->createMessaging();
    $notification = Notification::create('Start', 'It is Your Turn Go To  '. $seatNumber);

    $message = CloudMessage::withTarget('token', $user->fcm_token)->withNotification($notification);

    try {
        $response = $messaging->send($message);
        return response()->json([
            'message' => 'Notification has been sent',
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'message' => 'Failed to send notification',
            'error' => $e->getMessage(),
        ]);
    }
}
public function notifyEnd($user)
{
    \Log::info('User retrieved: ', (array)$user);

    if (!is_object($user) || !isset($user->fcm_token)) {
        return response()->json([
            'message' => 'Invalid user object',
            'error' => 'User must be an object with a non-null fcm_token property',
        ]);
    }

    $factory = (new Factory)->withServiceAccount(config_path('fcm.json'));
    $messaging = $factory->createMessaging();
    $notification = Notification::create('End', 'Your Queue End');

    $message = CloudMessage::withTarget('token', $user->fcm_token)->withNotification($notification);

    try {
        $response = $messaging->send($message);
        return response()->json([
            'message' => 'Notification has been sent',
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'message' => 'Failed to send notification',
            'error' => $e->getMessage(),
        ]);
    }
}



}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::get();
        return view('User.UserTable',compact('users'));
    }
    public function show(string $id)
    {
        $services=User::find($id);
        return view('User.ShowUser',compact('users'));
    }

    public function banUser(Request $request, $userId)
{
    $user = User::find($userId);
    $user->update(['banned' => true]);
    return redirect()->route('user')->with('banMessage', 'user has banned successfully');
}

public function unbanUser(Request $request, $userId)
{
    $user = User::find($userId);
    $user->update(['banned' => false]);
    return redirect()->route('user')->with('banMessage', 'user has unbanned successfully');
}

}

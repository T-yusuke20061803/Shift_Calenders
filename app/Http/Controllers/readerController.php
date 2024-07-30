<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class readerController extends Controller
{
    public function index()
    {
        return view('reader.index');
    }
    public function maangeUsers()
    {
        $users = User::all();
        return view('reader.users', compact('users'));
    }
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:reader,user',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('reader.users')->with('success', 'ユーザーの役割を更新。');
    }
}
